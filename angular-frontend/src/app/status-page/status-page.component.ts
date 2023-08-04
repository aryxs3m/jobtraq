import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {HttpClient} from "@angular/common/http";
import {environment} from "../../environments/environment";
import {isPlatformServer} from "@angular/common";

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
  isServer: boolean;

  constructor(private http: HttpClient, @Inject(PLATFORM_ID) platformId: Object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.http.get<any>(environment.api_url + 'healthcheck').subscribe(data => {
      this.frontendStatus = data.data.frontend;
      this.backendStatus = data.data.backend;
      this.scraperStatus = data.data.scrapers;

      this.loading = false;
    })
  }
}
