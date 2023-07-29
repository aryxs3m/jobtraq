import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SmallDividerComponent } from './small-divider.component';

describe('SmallDividerComponent', () => {
  let component: SmallDividerComponent;
  let fixture: ComponentFixture<SmallDividerComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [SmallDividerComponent]
    });
    fixture = TestBed.createComponent(SmallDividerComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
