import {Component, OnInit} from '@angular/core';
import {faCircleNotch, faSpinner} from "@fortawesome/free-solid-svg-icons";
import {Color, ScaleType} from "@swimlane/ngx-charts";
import {HttpClient} from "@angular/common/http";
import {PositionSalaries} from "../network/PositionSalaries";

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

  constructor(private http: HttpClient) {
  }

  ngOnInit(): void {
    this.http.get<any>('http://localhost/api/report/homepage').subscribe(data => {
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
      this.mostNeededStack = data.data.treeMapStacks[0].name;

      this.positionSalaries = data.data.positionSalaries;
      this.barStack = data.data.barStacks;

      this.loading = false;
    })
  }

}
