import { Injectable } from '@angular/core';
import * as moment from 'moment';
import { Subject } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class SearchService {
  dateFilterChange: Subject<Date> = new Subject<Date>();
  private _dateFilter: Date = new Date();

  constructor() {
    this.dateFilterChange.subscribe(value => {
      this._dateFilter = value;
    });
  }

  get dateFilter(): Date {
    return this._dateFilter;
  }

  set dateFilter(value: Date) {
    this.dateFilterChange.next(value);
  }

  public getDate() {
    return moment(this._dateFilter).format('YYYY-MM-DD');
  }
}
