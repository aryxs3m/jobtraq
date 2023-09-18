import { ComponentFixture, TestBed } from '@angular/core/testing';

import { FooterComponent } from './footer.component';
import {
  NgcCookieConsentConfig,
  NgcCookieConsentService,
  WindowService,
} from 'ngx-cookieconsent';

describe('FooterComponent', () => {
  let component: FooterComponent;
  let fixture: ComponentFixture<FooterComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [FooterComponent],
      providers: [
        NgcCookieConsentService,
        NgcCookieConsentConfig,
        WindowService,
      ],
    });
    fixture = TestBed.createComponent(FooterComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
