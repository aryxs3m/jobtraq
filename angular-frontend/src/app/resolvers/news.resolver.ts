import {
  ActivatedRouteSnapshot,
  ResolveFn,
  RouterStateSnapshot,
} from '@angular/router';
import { inject } from '@angular/core';
import { Observable, of } from 'rxjs';
import { map, catchError } from 'rxjs/operators';
import {NewsService} from "../services/news.service";
import {ArticleGetResponse} from "../network/ArticleGetResponse";
export const NewsResolver: ResolveFn<ArticleGetResponse> = (
  route: ActivatedRouteSnapshot,
  state: RouterStateSnapshot,
  newsService: NewsService = inject(NewsService)
): Observable<ArticleGetResponse> => {
  return newsService.getArticle(route.paramMap.get('slug') ?? '');
};
