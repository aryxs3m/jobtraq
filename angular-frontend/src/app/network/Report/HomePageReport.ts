import {PositionSalaries} from "./PositionSalaries";
import {ChartData} from "./ChartData";
import {BarStacks} from "./BarStacks";

export interface HomePageReport {
  isDataReady: boolean;
  pieChartPositions: ChartData[];
  barOpenPositions: ChartData[];
  treeMapStacks: ChartData[];
  positionSalaries: PositionSalaries[];
  barStacks: BarStacks[];
}
