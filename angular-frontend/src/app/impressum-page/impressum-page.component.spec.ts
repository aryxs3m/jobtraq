import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ImpressumPageComponent } from './impressum-page.component';
import { PageHeaderComponent } from '../page-header/page-header.component';

describe('ImpressumPageComponent', () => {
  let component: ImpressumPageComponent;
  let fixture: ComponentFixture<ImpressumPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ImpressumPageComponent, PageHeaderComponent],
    });
    fixture = TestBed.createComponent(ImpressumPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
