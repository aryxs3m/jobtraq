import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {NewsBlockItem} from "../network/NewsBlockItem";
import {ActivatedRoute} from "@angular/router";
import * as moment from "moment";
import {Marked} from "@ts-stack/markdown";
import {isPlatformServer} from "@angular/common";
import {ArticleGetResponse} from "../network/ArticleGetResponse";
import {LoaderService} from "../loader.service";
import {NewsService} from "../services/news.service";

@Component({
  selector: 'app-news-page',
  templateUrl: './news-page.component.html',
  styleUrls: ['./news-page.component.scss']
})
export class NewsPageComponent implements OnInit {
  newsBlock: NewsBlockItem|null = null;
  publishedDate: string = '';
  markdown: string = '';
  private response!: ArticleGetResponse;
  private readonly isServer: boolean;

  constructor(private route: ActivatedRoute, private loader: LoaderService, private newsService: NewsService, @Inject(PLATFORM_ID) platformId: Object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.route.data.subscribe(data => {
      console.log('Check route resolver data')
      // @ts-ignore
      this.loadArticle(<ArticleGetResponse>data.routeResolver);
    })
  }

  loadArticle(data: ArticleGetResponse) {
    if (data.status !== 'success') {
      this.loader.setBackendError(true);
      return;
    }

    this.newsBlock = data.data;
    this.publishedDate = moment(this.newsBlock.published_at).format('YYYY MMMM D');

    if (this.newsBlock.content) {
      this.markdown = Marked.parse(this.newsBlock.content);
    }
  }
}
