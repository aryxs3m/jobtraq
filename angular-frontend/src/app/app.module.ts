import { NgModule, isDevMode } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import {CommonModule, NgOptimizedImage} from "@angular/common";

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { HomePageComponent } from './home-page/home-page.component';
import { NotFoundPageComponent } from './not-found-page/not-found-page.component';
import { NgbModule } from '@ng-bootstrap/ng-bootstrap';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { NgxChartsModule } from "@swimlane/ngx-charts";
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { AboutPageComponent } from './about-page/about-page.component';
import { ContactPageComponent } from './contact-page/contact-page.component';
import {HTTP_INTERCEPTORS, HttpClientModule} from "@angular/common/http";
import {PositionSalaryChartComponent} from "./home-page/position-salary-chart/position-salary-chart.component";
import { NavbarComponent } from './navbar/navbar.component';
import {LoadingInterceptor} from "./loading.interceptor";
import { registerLocaleData } from '@angular/common';
import localeHu from '@angular/common/locales/hu';
import { StackSalaryChartComponent } from './home-page/stack-salary-chart/stack-salary-chart.component';
import { SmallDividerComponent } from './small-divider/small-divider.component';
import { ErrorNotifyComponent } from './error-notify/error-notify.component';
import { StatusPageComponent } from './status-page/status-page.component';
import { StatusItemComponent } from './status-page/status-item/status-item.component';
import { NoDataInfoComponent } from './home-page/no-data-info/no-data-info.component';
import { FooterComponent } from './footer/footer.component';
import { SystemMessageComponent } from './system-message/system-message.component';
import { ScrapingEthicsPageComponent } from './scraping-ethics-page/scraping-ethics-page.component';
import {PageHeaderComponent} from "./page-header/page-header.component";
import {NgxGa4Module} from "@kattoshi/ngx-ga4";
import {NgcCookieConsentConfig, NgcCookieConsentModule} from "ngx-cookieconsent";
import { ImpressumPageComponent } from './impressum-page/impressum-page.component';
import {environment} from "../environments/environment";
import { ContactCardComponent } from './contact-page/contact-card/contact-card.component';
import { ServiceWorkerModule } from '@angular/service-worker';
registerLocaleData(localeHu, 'hu');

const cookieConfig:NgcCookieConsentConfig = {
  "cookie": {
    "domain": environment.domain,
  },
  "position": "bottom-left",
  "theme": "block",
  "revokeBtn": "<span></span>",
  "palette": {
    "popup": {
      "background": "#333",
      "text": "#ffffff",
      "link": "#ffffff"
    },
    "button": {
      "background": "#12e773",
      "text": "#000000",
      "border": "transparent"
    }
  },
  "type": "opt-out",
  "content": {
    "message": "🍪 Sütiket használunk az analitikához. Engedélyezed?",
    "dismiss": "Oké!",
    "deny": "Nem szeretném",
    "link": "Adatvédelem",
    "href": "https://jobtraq.hu/privacy-policy",
    "policy": "Süti beállítások",
    "allow": "Engedélyezés",
  }
};

@NgModule({
  declarations: [
    AppComponent,
    HomePageComponent,
    NotFoundPageComponent,
    AboutPageComponent,
    ContactPageComponent,
    PositionSalaryChartComponent,
    NavbarComponent,
    StackSalaryChartComponent,
    SmallDividerComponent,
    ErrorNotifyComponent,
    StatusPageComponent,
    StatusItemComponent,
    NoDataInfoComponent,
    FooterComponent,
    SystemMessageComponent,
    ScrapingEthicsPageComponent,
    PageHeaderComponent,
    ImpressumPageComponent,
    ContactCardComponent,
  ],
    imports: [
        CommonModule,
        BrowserModule,
        AppRoutingModule,
        NgbModule,
        FontAwesomeModule,
        NgxChartsModule,
        BrowserAnimationsModule,
        HttpClientModule,
        NgxGa4Module.forRoot({}),
        NgcCookieConsentModule.forRoot(cookieConfig),
        NgOptimizedImage,
        ServiceWorkerModule.register('ngsw-worker.js', {
          enabled: !isDevMode(),
          // Register the ServiceWorker as soon as the application is stable
          // or after 30 seconds (whichever comes first).
          registrationStrategy: 'registerWhenStable:30000'
        }),
    ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS, useClass: LoadingInterceptor, multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
