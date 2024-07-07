import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class TrendService {

  constructor() { }

  public getTrendHumanReadable(values: number[]): string {
    const trend = this.calculateTrend(
      values.slice(Math.max(values.length - 5, 1))
    );

    if (trend === null || trend === 1) {
      return 'stagnál';
    }

    if (trend < 0.25) {
      return 'fogy';
    }

    return 'nő';
  }

  /**
   * @url https://github.com/freeall/trend
   * @param values
   */
  public calculateTrend(values: number[]) {
    let options = {
      lastPoints: 1,
      avgPoints: 3,
    };

    if (values.length < options.lastPoints + options.avgPoints) return null;

    const lastArr = values.slice(values.length - options.lastPoints, values.length);
    const chartArr = values.slice(
      values.length - options.lastPoints - options.avgPoints,
      values.length - options.lastPoints
    );

    const chartAvg = chartArr.reduce(function(res, val) { return res += val }) / chartArr.length;
    const lastAvg = Math.max.apply(null, lastArr);


    console.log(lastAvg, chartAvg)

    return lastAvg/chartAvg;
  }
}
