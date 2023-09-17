import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CommentsBlockComponent } from './comments-block.component';
import { HttpClientTestingModule } from '@angular/common/http/testing';
import { ReactiveFormsModule } from '@angular/forms';

describe('CommentsBlockComponent', () => {
  let component: CommentsBlockComponent;
  let fixture: ComponentFixture<CommentsBlockComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule, ReactiveFormsModule],
      declarations: [CommentsBlockComponent],
    });
    fixture = TestBed.createComponent(CommentsBlockComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.newsBlock = {
      slug: 'cikk-cime',
      title: 'Cikk címe',
      content: 'Cikk tartalma',
      image_url: 'https://example.com/image.jpg',
      published_at: new Date(),
      introduction: 'Bevezető szöveg',
    };

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
