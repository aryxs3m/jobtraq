import { PositionSalaries } from './PositionSalaries';
import { ChartData } from './ChartData';
import { BarStacks } from './BarStacks';
import {Popularity} from "./Popularity";
import {LangSalary} from "./LangSalary";

export interface LangReport {
  isDataReady: boolean;
  popularity: Popularity,
  salaries: LangSalary[],
  barOpenPositions: ChartData[];
  weeklySalaries: BarStacks[];
}
