import { PositionSalaries } from './PositionSalaries';
import { ChartData } from './ChartData';
import { BarStacks } from './BarStacks';
import {Popularity} from "./Popularity";
import {LangSalary} from "./LangSalary";

export interface LangReportSearchResponse {
  status: string;
  data: {
    stacks: string[];
  }
}
