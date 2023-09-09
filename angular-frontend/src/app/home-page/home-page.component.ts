import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {faCircleNotch, faExclamationTriangle, faSpinner} from "@fortawesome/free-solid-svg-icons";
import {Color, ScaleType} from "@swimlane/ngx-charts";
import {HttpClient} from "@angular/common/http";
import {LoaderService} from "../loader.service";
import {ActivatedRoute, Data, Params} from "@angular/router";
import {SearchService} from "../search.service";
import {environment} from "../../environments/environment";
import {isPlatformServer} from "@angular/common";

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

  pieChartPositions = [];
  positionsMostOpen: string = '';

  barOpenPositions = [];
  positionsTrend: string = 'stagnál';

  treeMapStacks = [];
  mostNeededStack: string = '';

  positionSalaries: any[] = [];

  barStack = [];
  protected readonly faSpinner = faSpinner;
  protected readonly faCircleNotch = faCircleNotch;

  loading: boolean = true;
  isReady: boolean = true;
  isServer: boolean;

  constructor(private http: HttpClient, private loader: LoaderService, private route: ActivatedRoute,
              private search: SearchService, @Inject(PLATFORM_ID) platformId: Object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.route.params.subscribe(params => {
      this.loadCharts();
    })
  }

  protected loadCharts() {
    if (this.isServer) {
      return;
    }

    this.loading = true;
    this.isReady = true;

    let dateFilter = this.route.snapshot.paramMap.get('date');

    if (dateFilter) {
      this.search.dateFilter = new Date(dateFilter);
    }

    let apiRoute = dateFilter ?
      `report/homepage?date=${dateFilter}` :
      'report/homepage';

    this.http.get<any>(environment.api_url + apiRoute).subscribe(data => {
        this.isReady = data.data.isDataReady;

        if (data.data.isDataReady === false) {
          return;
        }

        this.pieChartPositions = data.data.pieChartPositions;
        this.positionsMostOpen = data.data.pieChartPositions[0].name;

        this.barOpenPositions = data.data.barOpenPositions;
        let openPositionsWeeks = data.data.barOpenPositions.length;
        if (openPositionsWeeks > 1) {
          let distance = this.barOpenPositions[openPositionsWeeks - 2] - this.barOpenPositions[openPositionsWeeks - 1];
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
      error => {
        this.loader.setBackendError(true);
      })
  }

  protected readonly faExclamationTriangle = faExclamationTriangle;

  formatterPiece(value: any) {
    return `${value} db`;
  }

  formatterWeek(value: any) {
    return `${value}. hét`;
  }
}
