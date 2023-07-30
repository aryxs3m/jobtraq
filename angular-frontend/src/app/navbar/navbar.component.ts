import { Component } from '@angular/core';
import { LoaderService } from "../loader.service";
import {animate, state, style, transition, trigger} from "@angular/animations";
import {SearchService} from "../search.service";
import {Router} from "@angular/router";
import {faGithub} from "@fortawesome/free-brands-svg-icons";

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.scss'],
  animations: [
    trigger('openClose', [
      state('open', style({
        opacity: 1,
      })),
      state('closed', style({
        opacity: 0,
      })),
      transition('open => closed', [
        animate('1s')
      ]),
      transition('closed => open', [
        animate('0.5s')
      ]),
    ]),
  ],
})
export class NavbarComponent {
  constructor(public loader: LoaderService, public search: SearchService, private router: Router) {
    console.log(search.getDate());
  }

  setDate(event: any) {
    this.search.dateFilter = new Date(event.target.value);
    this.router.navigateByUrl('/report/'+this.search.getDate());
  }

  protected readonly faGithub = faGithub;
}
