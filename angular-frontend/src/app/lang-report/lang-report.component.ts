import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {Color, ScaleType} from "@swimlane/ngx-charts";
import {ChartData} from "../network/Report/ChartData";
import {HttpClient} from "@angular/common/http";
import {LoaderService} from "../loader.service";
import {ActivatedRoute} from "@angular/router";
import {isPlatformServer} from "@angular/common";
import {environment} from "../../environments/environment";
import {BarStacks} from "../network/Report/BarStacks";
import {LangReportResponse} from "../network/Report/LangReportResponse";
import {TrendService} from "../services/trend.service";
import {Popularity} from "../network/Report/Popularity";
import {LangSalary} from "../network/Report/LangSalary";
import {DetailFormatter} from "../utils/formatter/detail-formatter";

@Component({
  selector: 'app-lang-report',
  templateUrl: './lang-report.component.html',
  styleUrls: ['./lang-report.component.scss']
})
export class LangReportComponent implements OnInit {
  colorScheme: Color = {
    name: 'nyeko',
    selectable: true,
    group: ScaleType.Ordinal,
    domain: ['#00C992', '#00A99F', '#008898', '#00677E', '#2F4858'],
  };

  public loading = false;

  public lang?: string|null;
  public positionsTrend = 'stagnál';
  public popularity?: Popularity;
  public salaries?: LangSalary[];

  barOpenPositions: ChartData[] = [];
  barSalaries: BarStacks[] = [];

  private isServer: boolean;
  public isReady = false;

  constructor(
    private http: HttpClient,
    private loader: LoaderService,
    private route: ActivatedRoute,
    private trend: TrendService,
    @Inject(PLATFORM_ID) platformId: object
  ) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.route.params.subscribe(() => {
      this.loadCharts();
    });
  }
  protected loadCharts() {
    if (this.isServer) {
      return;
    }

    this.loading = true;
    this.isReady = true;

    const langFilter = this.route.snapshot.paramMap.get('lang');
    this.lang = langFilter;
    const apiRoute = `report/lang?lang=${langFilter}`;

    this.http
      .get<LangReportResponse>(environment.api_url + apiRoute)
      .subscribe(
        data => {
          this.isReady = data.data.isDataReady;

          if (!data.data.isDataReady) {
            return;
          }

          this.popularity = data.data.popularity;
          this.salaries = data.data.salaries;
          this.barSalaries = data.data.weeklySalaries;
          this.barOpenPositions = data.data.barOpenPositions;

          this.positionsTrend = this.trend.getTrendHumanReadable(this.barOpenPositions.map((item) => item.value));

          this.loading = false;
        },
        () => {
          this.loader.setBackendError(true);
        }
      );
  }

  formatterPiece(value: number | string) {
    return `${value} db`;
  }

  formatterWeek(value: number | string) {
    return `${value}. hét`;
  }

  protected readonly DetailFormatter = DetailFormatter;
}
