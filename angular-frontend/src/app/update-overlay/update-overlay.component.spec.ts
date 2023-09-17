import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateOverlayComponent } from './update-overlay.component';

describe('UpdateOverlayComponent', () => {
  let component: UpdateOverlayComponent;
  let fixture: ComponentFixture<UpdateOverlayComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [UpdateOverlayComponent],
    });
    fixture = TestBed.createComponent(UpdateOverlayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
