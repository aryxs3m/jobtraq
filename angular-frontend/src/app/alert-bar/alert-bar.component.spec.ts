import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AlertBarComponent } from './alert-bar.component';

describe('AlertBarComponent', () => {
  let component: AlertBarComponent;
  let fixture: ComponentFixture<AlertBarComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [AlertBarComponent],
    });
    fixture = TestBed.createComponent(AlertBarComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
