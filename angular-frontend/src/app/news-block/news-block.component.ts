import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {NewsBlockItem} from "../network/NewsBlockItem";
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {isPlatformServer} from "@angular/common";
import {ArticleListResponse} from "../network/ArticleListResponse";
import {LoaderService} from "../loader.service";

@Component({
  selector: 'app-news-block',
  templateUrl: './news-block.component.html',
  styleUrls: ['./news-block.component.scss']
})
export class NewsBlockComponent implements OnInit {
  blocks: NewsBlockItem[] = [];

  private readonly isServer: boolean;

  constructor(private http: HttpClient, private loader: LoaderService, @Inject(PLATFORM_ID) platformId: Object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.http.get<ArticleListResponse>(environment.api_url + 'articles?limit=3').subscribe(data => {
      if (data.status === 'error') {
        this.loader.setBackendError(true);

        return;
      }

      this.blocks = data.data;
    }, error => {
      this.loader.setBackendError(true);
    })
  }
}
