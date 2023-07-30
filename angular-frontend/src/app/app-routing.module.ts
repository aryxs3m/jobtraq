import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {HomePageComponent} from "./home-page/home-page.component";
import {NotFoundPageComponent} from "./not-found-page/not-found-page.component";
import {AboutPageComponent} from "./about-page/about-page.component";
import {ContactPageComponent} from "./contact-page/contact-page.component";
import {StatusPageComponent} from "./status-page/status-page.component";
import {ScrapingEthicsPageComponent} from "./scraping-ethics-page/scraping-ethics-page.component";

const routes: Routes = [
  { path: 'report', component: HomePageComponent },
  { path: 'report/:date', component: HomePageComponent },
  { path: 'about-us', component: AboutPageComponent },
  { path: 'status', component: StatusPageComponent },
  { path: 'contact', component: ContactPageComponent },
  { path: 'our-scraping-ethics', component: ScrapingEthicsPageComponent },
  { path: '', redirectTo: "/report", pathMatch: "full" },
  { path: '**', component: NotFoundPageComponent },
];
@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
