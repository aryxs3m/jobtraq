import { ComponentFixture, TestBed } from '@angular/core/testing';

import { NewsCardComponent } from './news-card.component';
import { RouterTestingModule } from '@angular/router/testing';

describe('NewsCardComponent', () => {
  let component: NewsCardComponent;
  let fixture: ComponentFixture<NewsCardComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [RouterTestingModule],
      declarations: [NewsCardComponent],
    });
    fixture = TestBed.createComponent(NewsCardComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.articleLink = 'https://asd.com';
    component.publishDate = '2023-01-01 00:00:00';
    component.newsBlock = {
      title: 'Cikk címe',
      content: 'Cikk **tartalma.**',
      image_url: 'https://example.com/image.jpg',
      slug: 'cikk-cime',
      introduction: 'Bevezető.',
      published_at: new Date(),
    };

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
