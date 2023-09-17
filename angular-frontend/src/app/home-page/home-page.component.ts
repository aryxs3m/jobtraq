import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {faCircleNotch, faSpinner} from "@fortawesome/free-solid-svg-icons";
import {Color, ScaleType} from "@swimlane/ngx-charts";
import {HttpClient} from "@angular/common/http";
import {LoaderService} from "../loader.service";
import {ActivatedRoute} from "@angular/router";
import {SearchService} from "../search.service";
import {environment} from "../../environments/environment";
import {isPlatformServer} from "@angular/common";
import {HomePageReportResponse} from "../network/Report/HomePageReportResponse";
import {ChartData} from "../network/Report/ChartData";
import {PositionSalaries} from "../network/Report/PositionSalaries";
import {BarStacks} from "../network/Report/BarStacks";

@Component({
  selector: 'app-home-page',
  templateUrl: './home-page.component.html',
  styleUrls: ['./home-page.component.scss']
})
export class HomePageComponent implements OnInit {
  colorScheme: Color = {
    name: 'nyeko',
    selectable: true,
    group: ScaleType.Ordinal,
    domain: ['#00C992', '#00A99F', '#008898', '#00677E', '#2F4858']
  };

  pieChartPositions: ChartData[] = [];
  positionsMostOpen = '';

  barOpenPositions: ChartData[] = [];
  positionsTrend = 'stagnál';

  treeMapStacks: ChartData[] = [];
  mostNeededStack = '';

  positionSalaries: PositionSalaries[] = [];

  barStack: BarStacks[] = [];
  protected readonly faSpinner = faSpinner;
  protected readonly faCircleNotch = faCircleNotch;

  loading = true;
  isReady = true;
  isServer: boolean;

  constructor(private http: HttpClient, private loader: LoaderService, private route: ActivatedRoute,
              private search: SearchService, @Inject(PLATFORM_ID) platformId: object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.route.params.subscribe(() => {
      this.loadCharts();
    })
  }

  protected loadCharts() {
    if (this.isServer) {
      return;
    }

    this.loading = true;
    this.isReady = true;

    const dateFilter = this.route.snapshot.paramMap.get('date');

    if (dateFilter) {
      this.search.dateFilter = new Date(dateFilter);
    }

    const apiRoute = dateFilter ?
      `report/homepage?date=${dateFilter}` :
      'report/homepage';

    this.http.get<HomePageReportResponse>(environment.api_url + apiRoute).subscribe(data => {
        this.isReady = data.data.isDataReady;

        if (!data.data.isDataReady) {
          return;
        }

        this.pieChartPositions = data.data.pieChartPositions;
        this.positionsMostOpen = data.data.pieChartPositions[0].name;

        this.barOpenPositions = data.data.barOpenPositions;
        const openPositionsWeeks = data.data.barOpenPositions.length;
        console.log(this.barOpenPositions[openPositionsWeeks - 2]);
        if (openPositionsWeeks > 1) {
          const distance = this.barOpenPositions[openPositionsWeeks - 2].value - this.barOpenPositions[openPositionsWeeks - 1].value;
          if (distance > 5) {
            this.positionsTrend = 'fogy';
          } else if (distance < 5) {
            this.positionsTrend = 'nő';
          }
        }

        this.treeMapStacks = data.data.treeMapStacks;
        this.mostNeededStack = data.data.treeMapStacks[0]?.name;

        this.positionSalaries = data.data.positionSalaries;
        this.barStack = data.data.barStacks;

        this.loading = false;
      },
      () => {
        this.loader.setBackendError(true);
      })
  }

  formatterPiece(value: number | string) {
    return `${value} db`;
  }

  formatterWeek(value: number | string) {
    return `${value}. hét`;
  }
}
