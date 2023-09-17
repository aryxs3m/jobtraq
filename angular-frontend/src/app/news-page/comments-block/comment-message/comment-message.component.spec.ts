import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CommentMessageComponent } from './comment-message.component';

describe('CommentMessageComponent', () => {
  let component: CommentMessageComponent;
  let fixture: ComponentFixture<CommentMessageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CommentMessageComponent],
    });
    fixture = TestBed.createComponent(CommentMessageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
