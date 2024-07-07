import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LangReportHomeComponent } from './lang-report-home.component';

describe('LangReportHomeComponent', () => {
  let component: LangReportHomeComponent;
  let fixture: ComponentFixture<LangReportHomeComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [LangReportHomeComponent]
    });
    fixture = TestBed.createComponent(LangReportHomeComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
