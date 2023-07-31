import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../environments/environment";

@Component({
  selector: 'app-status-page',
  templateUrl: './status-page.component.html',
  styleUrls: ['./status-page.component.scss']
})
export class StatusPageComponent implements OnInit {
  loading: boolean = true;

  frontendStatus: boolean = false;
  backendStatus: boolean = false;
  scraperStatus: any = [];

  constructor(private http: HttpClient) {
  }

  ngOnInit(): void {
    this.http.get<any>(environment.api_url + 'healthcheck').subscribe(data => {
      this.frontendStatus = data.data.frontend;
      this.backendStatus = data.data.backend;
      this.scraperStatus = data.data.scrapers;

      this.loading = false;
    })
  }
}
