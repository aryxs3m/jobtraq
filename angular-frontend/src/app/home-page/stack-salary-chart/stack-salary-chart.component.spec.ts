import { ComponentFixture, TestBed } from '@angular/core/testing';

import { StackSalaryChartComponent } from './stack-salary-chart.component';
import { NgxChartsModule, ScaleType } from '@swimlane/ngx-charts';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';

describe('StackSalaryChartComponent', () => {
  let component: StackSalaryChartComponent;
  let fixture: ComponentFixture<StackSalaryChartComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [NgxChartsModule, NoopAnimationsModule],
      declarations: [StackSalaryChartComponent],
    });
    fixture = TestBed.createComponent(StackSalaryChartComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.colorScheme = {
      name: 'test',
      selectable: true,
      group: ScaleType.Ordinal,
      domain: ['#00C992', '#00A99F', '#008898', '#00677E', '#2F4858'],
    };
    component.barStack = [
      {
        name: 'teszt',
        series: [
          {
            name: 'teszt',
            value: 1,
          },
          {
            name: 'teszt',
            value: 10,
          },
        ],
      },
    ];

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
