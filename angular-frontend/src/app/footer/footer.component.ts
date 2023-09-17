import { Component } from '@angular/core';
import { NgcCookieConsentService } from 'ngx-cookieconsent';

@Component({
  selector: 'app-footer',
  templateUrl: './footer.component.html',
  styleUrls: ['./footer.component.scss'],
})
export class FooterComponent {
  constructor(private cookieConsent: NgcCookieConsentService) {}

  backToTop() {
    window.scrollTo({ top: 0 });
  }

  showCookieConsent() {
    this.cookieConsent.fadeIn();
  }
}
