import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PositionSalaryChartComponent } from './position-salary-chart.component';
import { SmallDividerComponent } from '../../small-divider/small-divider.component';
import { NgxChartsModule, ScaleType } from '@swimlane/ngx-charts';

import localeHu from '@angular/common/locales/hu';
import { registerLocaleData } from '@angular/common';
import { NoopAnimationsModule } from '@angular/platform-browser/animations';
registerLocaleData(localeHu, 'hu');

describe('PositionSalaryChartComponent', () => {
  let component: PositionSalaryChartComponent;
  let fixture: ComponentFixture<PositionSalaryChartComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [NgxChartsModule, NoopAnimationsModule],
      declarations: [PositionSalaryChartComponent, SmallDividerComponent],
    });
    fixture = TestBed.createComponent(PositionSalaryChartComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.position = 'Backend';
    component.colorScheme = {
      name: 'test',
      selectable: true,
      group: ScaleType.Ordinal,
      domain: ['#00C992', '#00A99F', '#008898', '#00677E', '#2F4858'],
    };
    component.data = [
      {
        name: 'teszt',
        value: 1,
      },
      {
        name: 'teszt',
        value: 10,
      },
    ];

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
