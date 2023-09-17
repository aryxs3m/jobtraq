import { ComponentFixture, TestBed } from '@angular/core/testing';

import { StatusPageComponent } from './status-page.component';
import { HttpClientTestingModule } from '@angular/common/http/testing';
import { PageHeaderComponent } from '../page-header/page-header.component';

describe('StatusPageComponent', () => {
  let component: StatusPageComponent;
  let fixture: ComponentFixture<StatusPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule],
      declarations: [StatusPageComponent, PageHeaderComponent],
    });
    fixture = TestBed.createComponent(StatusPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
