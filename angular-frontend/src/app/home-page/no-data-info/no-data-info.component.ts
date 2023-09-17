import {Component, Input} from '@angular/core';
import {SearchService} from "../../search.service";
import {faExclamationTriangle} from "@fortawesome/free-solid-svg-icons";
import {Router} from "@angular/router";

@Component({
  selector: 'app-no-data-info',
  templateUrl: './no-data-info.component.html',
  styleUrls: ['./no-data-info.component.scss']
})
export class NoDataInfoComponent {
  today = true;

  @Input() visible!: boolean;

  constructor(private search: SearchService, private router: Router) {
    search.dateFilterChange.subscribe(() => {
      this.changeState();
    })
  }

  private changeState() {
    const date: Date = new Date();

    if (this.search.dateFilter.toDateString() === date.toDateString()) {
      this.today = true;
    } else {
      this.today = false;
    }
  }

  protected readonly faExclamationTriangle = faExclamationTriangle;

  goToday() {
    this.search.dateFilter = new Date();
    this.router.navigateByUrl('/report');
  }
}
