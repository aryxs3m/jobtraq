import {Component, Input, OnInit} from '@angular/core';
import {Color} from "@swimlane/ngx-charts";

@Component({
  selector: 'app-stack-salary-chart',
  templateUrl: './stack-salary-chart.component.html',
  styleUrls: ['./stack-salary-chart.component.scss']
})
export class StackSalaryChartComponent {

  @Input() barStack!: any[];
  @Input() colorScheme!: Color;
}
