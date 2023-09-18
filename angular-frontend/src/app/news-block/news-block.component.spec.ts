import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NewsBlockComponent } from './news-block.component';
import { HttpClientTestingModule } from '@angular/common/http/testing';
import { SkeletonNewsCardComponent } from './skeleton-news-card/skeleton-news-card.component';
import { NgxSkeletonLoaderModule } from 'ngx-skeleton-loader';

describe('NewsBlockComponent', () => {
  let component: NewsBlockComponent;
  let fixture: ComponentFixture<NewsBlockComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule, NgxSkeletonLoaderModule],
      declarations: [NewsBlockComponent, SkeletonNewsCardComponent],
    });
    fixture = TestBed.createComponent(NewsBlockComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
