import { HomePageReport } from './HomePageReport';
import {LangReport} from "./LangReport";

export interface LangReportResponse {
  status: string; // TODO enum
  data: LangReport;
}
