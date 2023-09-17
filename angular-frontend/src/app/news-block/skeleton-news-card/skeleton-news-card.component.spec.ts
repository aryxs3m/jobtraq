import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SkeletonNewsCardComponent } from './skeleton-news-card.component';

describe('SkeletonNewsCardComponent', () => {
  let component: SkeletonNewsCardComponent;
  let fixture: ComponentFixture<SkeletonNewsCardComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [SkeletonNewsCardComponent],
    });
    fixture = TestBed.createComponent(SkeletonNewsCardComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
