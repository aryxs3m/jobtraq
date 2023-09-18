import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ScrapingEthicsPageComponent } from './scraping-ethics-page.component';
import { PageHeaderComponent } from '../page-header/page-header.component';

describe('ScrapingEthicsPageComponent', () => {
  let component: ScrapingEthicsPageComponent;
  let fixture: ComponentFixture<ScrapingEthicsPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [ScrapingEthicsPageComponent, PageHeaderComponent],
    });
    fixture = TestBed.createComponent(ScrapingEthicsPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
