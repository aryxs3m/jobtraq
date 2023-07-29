import {Component, Input, OnInit} from '@angular/core';
import {Color} from "@swimlane/ngx-charts";

@Component({
  selector: 'app-position-salary-chart',
  templateUrl: './position-salary-chart.component.html',
  styleUrls: ['./position-salary-chart.component.scss']
})
export class PositionSalaryChartComponent implements OnInit {

  @Input() data!: ({ name: string; value: number })[];
  @Input() colorScheme!: Color;
  @Input() position!: string;

  top: string = '';
  avgSalary: number = 0;

  ngOnInit(): void {
    this.top = this.data[0].name

    let sum = 0;
    this.data.forEach((item) => {
      sum += item.value;
    })
    this.avgSalary = sum / this.data.length;
  }
}
