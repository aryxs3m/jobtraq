import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NotFoundPageComponent } from './not-found-page.component';
import { SmallDividerComponent } from '../small-divider/small-divider.component';

describe('NotFoundPageComponent', () => {
  let component: NotFoundPageComponent;
  let fixture: ComponentFixture<NotFoundPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [NotFoundPageComponent, SmallDividerComponent],
    });
    fixture = TestBed.createComponent(NotFoundPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
