import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NoDataInfoComponent } from './no-data-info.component';

describe('NoDataInfoComponent', () => {
  let component: NoDataInfoComponent;
  let fixture: ComponentFixture<NoDataInfoComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [NoDataInfoComponent],
    });
    fixture = TestBed.createComponent(NoDataInfoComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
