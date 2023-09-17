import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PositionSalaryChartComponent } from './position-salary-chart.component';

describe('PositionSalaryChartComponent', () => {
  let component: PositionSalaryChartComponent;
  let fixture: ComponentFixture<PositionSalaryChartComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [PositionSalaryChartComponent],
    });
    fixture = TestBed.createComponent(PositionSalaryChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
