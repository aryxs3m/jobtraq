import { ComponentFixture, TestBed } from '@angular/core/testing';

import { SkeletonNewsCardComponent } from './skeleton-news-card.component';
import { NgxSkeletonLoaderModule } from 'ngx-skeleton-loader';

describe('SkeletonNewsCardComponent', () => {
  let component: SkeletonNewsCardComponent;
  let fixture: ComponentFixture<SkeletonNewsCardComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [NgxSkeletonLoaderModule],
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
