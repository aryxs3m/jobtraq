import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ArticleGetResponse } from '../network/ArticleGetResponse';
import { environment } from '../../environments/environment';
import { LoaderService } from '../loader.service';
import { Observable } from 'rxjs';
@Injectable({
  providedIn: 'root',
})
export class NewsService {
  constructor(
    public http: HttpClient,
    private loader: LoaderService
  ) {}

  getArticle(slug: string): Observable<ArticleGetResponse> {
    return this.http.get<ArticleGetResponse>(
      environment.api_url + `articles/get?slug=${slug}`
    );
  }
}
