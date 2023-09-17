import { Component, Input } from '@angular/core';
import { Color } from '@swimlane/ngx-charts';
import { BarStacks } from '../../network/Report/BarStacks';

@Component({
  selector: 'app-stack-salary-chart',
  templateUrl: './stack-salary-chart.component.html',
  styleUrls: ['./stack-salary-chart.component.scss'],
})
export class StackSalaryChartComponent {
  @Input() barStack!: BarStacks[];
  @Input() colorScheme!: Color;
}
