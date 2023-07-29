import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { CommonModule } from "@angular/common";

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
import localeFr from '@angular/common/locales/hu';
import { StackSalaryChartComponent } from './home-page/stack-salary-chart/stack-salary-chart.component';
import { SmallDividerComponent } from './small-divider/small-divider.component';
import { ErrorNotifyComponent } from './error-notify/error-notify.component';
import { StatusPageComponent } from './status-page/status-page.component';
import { StatusItemComponent } from './status-page/status-item/status-item.component';
registerLocaleData(localeFr, 'hu');

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
  ],
  imports: [
    CommonModule,
    BrowserModule,
    AppRoutingModule,
    NgbModule,
    FontAwesomeModule,
    NgxChartsModule,
    BrowserAnimationsModule,
    HttpClientModule
  ],
  providers: [
    {
      provide: HTTP_INTERCEPTORS, useClass: LoadingInterceptor, multi: true
    }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
