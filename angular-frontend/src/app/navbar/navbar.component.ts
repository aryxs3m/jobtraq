import { Component } from '@angular/core';
import { LoaderService } from "../loader.service";
import {SearchService} from "../search.service";
import {NavigationStart, Router} from "@angular/router";
import {faDiscord, faGithub} from "@fortawesome/free-brands-svg-icons";
import {environment} from "../../environments/environment";
import * as moment from 'moment';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss'],
})
export class NavbarComponent {
  protected readonly faGithub = faGithub;
  collapsed: boolean = true;
  launchDate: string = environment.launchDate;
  todayDate: string = moment(new Date()).format('YYYY-MM-DD');

  constructor(public loader: LoaderService, public search: SearchService, private router: Router) {
    this.router.events
      .subscribe(
        (event: any) => {
          if (event instanceof NavigationStart) {
            this.collapsed = true;
          }
        });
  }

  setDate(event: any) {
    this.search.dateFilter = new Date(event.target.value);
    this.router.navigateByUrl('/report/'+this.search.getDate());
  }

  toggleMenu() {
    this.collapsed = !this.collapsed;
  }

  protected readonly faDiscord = faDiscord;
  protected readonly environment = environment;
}
