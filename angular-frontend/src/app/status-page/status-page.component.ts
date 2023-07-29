import {Component, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-status-page',
  templateUrl: './status-page.component.html',
  styleUrls: ['./status-page.component.scss']
})
export class StatusPageComponent implements OnInit {
  loading: boolean = true;

  frontendStatus: boolean = false;
  backendStatus: boolean = false;
  crawlerStatus: any = [];

  constructor(private http: HttpClient) {
  }

  ngOnInit(): void {
    this.http.get<any>('http://localhost/api/healthcheck').subscribe(data => {
      this.frontendStatus = data.data.frontend;
      this.backendStatus = data.data.backend;
      this.crawlerStatus = data.data.crawlers;

      this.loading = false;
    })
  }
}
