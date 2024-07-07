import { Component } from '@angular/core';
import {HomePageReportResponse} from "../network/Report/HomePageReportResponse";
import {environment} from "../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {LangReportSearchResponse} from "../network/Report/LangReportSearchResponse";

@Component({
  selector: 'app-lang-report-home',
  templateUrl: './lang-report-home.component.html',
  styleUrls: ['./lang-report-home.component.scss']
})
export class LangReportHomeComponent {
  showResults: boolean = false;
  searchResults: string[] = [];
  searchValue: string = '';

  constructor(private http: HttpClient) {
  }

  searchChange() {
    const apiRoute = `search/stack?keyword=${this.searchValue}`;

    this.http
      .get<LangReportSearchResponse>(environment.api_url + apiRoute)
      .subscribe(
        data => {
          this.searchResults = data.data.stacks;

          this.showResults = true;
        });
  }
}
