import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CommentMessageComponent } from './comment-message.component';
import { NgOptimizedImage } from '@angular/common';

describe('CommentMessageComponent', () => {
  let component: CommentMessageComponent;
  let fixture: ComponentFixture<CommentMessageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [NgOptimizedImage],
      declarations: [CommentMessageComponent],
    });
    fixture = TestBed.createComponent(CommentMessageComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.comment = {
      created_at: new Date(),
      message: 'Teszt üzenet',
      name: 'Név',
      is_op: false,
    };

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
