import { ComponentFixture, TestBed } from '@angular/core/testing';

import { StackSalaryChartComponent } from './stack-salary-chart.component';

describe('StackSalaryChartComponent', () => {
  let component: StackSalaryChartComponent;
  let fixture: ComponentFixture<StackSalaryChartComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [StackSalaryChartComponent],
    });
    fixture = TestBed.createComponent(StackSalaryChartComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
