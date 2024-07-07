import { PositionSalaries } from './PositionSalaries';
import { ChartData } from './ChartData';
import { BarStacks } from './BarStacks';

export interface LangSalary {
  level: string;
  values: {
    median: number;
    average: number;
  };
}
