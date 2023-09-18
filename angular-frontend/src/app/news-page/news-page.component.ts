import { Component, Inject, OnInit, PLATFORM_ID } from '@angular/core';
import { NewsBlockItem } from '../network/NewsBlockItem';
import { ActivatedRoute } from '@angular/router';
import * as moment from 'moment';
import { Marked } from '@ts-stack/markdown';
import { isPlatformServer } from '@angular/common';
import { ArticleGetResponse } from '../network/ArticleGetResponse';
import { LoaderService } from '../loader.service';
import { NewsService } from '../services/news.service';
import { Meta } from '@angular/platform-browser';
import { environment } from '../../environments/environment';

@Component({
  selector: 'app-news-page',
  templateUrl: './news-page.component.html',
  styleUrls: ['./news-page.component.scss'],
})
export class NewsPageComponent implements OnInit {
  newsBlock: NewsBlockItem | null = null;
  publishedDate = '';
  markdown = '';
  private response!: ArticleGetResponse;
  private readonly isServer: boolean;

  constructor(
    private route: ActivatedRoute,
    private loader: LoaderService,
    private newsService: NewsService,
    @Inject(PLATFORM_ID) platformId: object,
    private meta: Meta
  ) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      // TODO: egyelőre engedélyezem meta tagek miatt. Ha performance gond van, tiltani kell server side esetén újra.
      // return;
    }

    this.route.data.subscribe(data => {
      // TODO: test
      this.loadArticle(<ArticleGetResponse>data['routeResolver']);
    });
  }

  loadArticle(data: ArticleGetResponse) {
    if (data.status !== 'success') {
      this.loader.setBackendError(true);
      return;
    }

    this.newsBlock = data.data;
    this.publishedDate = moment(this.newsBlock.published_at).format(
      'YYYY MMMM D'
    );

    this.meta.updateTag({
      name: 'description',
      content: this.newsBlock.introduction,
    });
    this.meta.updateTag({
      name: 'og:image',
      content: this.newsBlock.image_url,
    });
    this.meta.addTag({
      name: 'og:title',
      content: this.newsBlock.title,
    });

    if (this.newsBlock.content) {
      this.markdown = Marked.parse(this.newsBlock.content);
    }
  }

  protected readonly environment = environment;
}
