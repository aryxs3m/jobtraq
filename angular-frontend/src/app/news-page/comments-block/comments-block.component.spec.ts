import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CommentsBlockComponent } from './comments-block.component';

describe('CommentsBlockComponent', () => {
  let component: CommentsBlockComponent;
  let fixture: ComponentFixture<CommentsBlockComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CommentsBlockComponent]
    });
    fixture = TestBed.createComponent(CommentsBlockComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
