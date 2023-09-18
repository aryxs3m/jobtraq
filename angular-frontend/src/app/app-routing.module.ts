import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomePageComponent } from './home-page/home-page.component';
import { NotFoundPageComponent } from './not-found-page/not-found-page.component';
import { AboutPageComponent } from './about-page/about-page.component';
import { ContactPageComponent } from './contact-page/contact-page.component';
import { StatusPageComponent } from './status-page/status-page.component';
import { ScrapingEthicsPageComponent } from './scraping-ethics-page/scraping-ethics-page.component';
import { ImpressumPageComponent } from './impressum-page/impressum-page.component';
import { NewsPageComponent } from './news-page/news-page.component';
import { NewsResolver } from './resolvers/news.resolver';
import { PrivacyPolicyPageComponent } from './privacy-policy-page/privacy-policy-page.component';

const routes: Routes = [
  { path: 'report', component: HomePageComponent },
  { path: 'report/:date', component: HomePageComponent },
  {
    path: 'news/:slug',
    component: NewsPageComponent,
    resolve: {
      routeResolver: NewsResolver,
    },
  },
  { path: 'about-us', component: AboutPageComponent },
  { path: 'status', component: StatusPageComponent },
  { path: 'contact', component: ContactPageComponent },
  { path: 'our-scraping-ethics', component: ScrapingEthicsPageComponent },
  { path: 'impressum', component: ImpressumPageComponent },
  { path: 'privacy-policy', component: PrivacyPolicyPageComponent },
  { path: '', redirectTo: '/report', pathMatch: 'full' },
  { path: '**', component: NotFoundPageComponent },
];
@NgModule({
  imports: [
    RouterModule.forRoot(routes, {
      scrollPositionRestoration: 'enabled',
      initialNavigation: 'enabledBlocking',
    }),
  ],
  exports: [RouterModule],
})
export class AppRoutingModule {}
