import { ComponentFixture, TestBed } from '@angular/core/testing';

import { LangReportComponent } from './lang-report.component';

describe('LangReportComponent', () => {
  let component: LangReportComponent;
  let fixture: ComponentFixture<LangReportComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [LangReportComponent]
    });
    fixture = TestBed.createComponent(LangReportComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
