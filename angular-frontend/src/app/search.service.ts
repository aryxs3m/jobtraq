import { Injectable } from '@angular/core';
import * as moment from 'moment';


@Injectable({
  providedIn: 'root'
})
export class SearchService {

  private _dateFilter: Date = new Date();

  constructor() { }

  get dateFilter(): Date {
    return this._dateFilter;
  }

  set dateFilter(value: Date) {
    this._dateFilter = value;
  }

  public getDate() {
    return moment(this._dateFilter).format('YYYY-MM-DD')
  }
}
