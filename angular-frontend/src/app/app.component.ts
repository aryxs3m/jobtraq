import { Component, OnInit } from '@angular/core';
import { NgcCookieConsentService } from 'ngx-cookieconsent';
import { NgxGa4Service } from '@kattoshi/ngx-ga4';
import { CookieService } from 'ngx-cookie-service';
import { Subscription } from 'rxjs';
import { environment } from '../environments/environment';
import { Meta } from '@angular/platform-browser';
import { UpdateService } from './update.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss'],
})
export class AppComponent implements OnInit {
  title = 'angular-frontend';
  private statusChangeSubscription!: Subscription;

  constructor(
    private ccService: NgcCookieConsentService,
    private _ga4: NgxGa4Service,
    private cookieService: CookieService,
    private meta: Meta,
    private update: UpdateService
  ) {
    meta.addTags([
      {
        name: 'description',
        content:
          'A JobTraq naponta frissülő kimutatást készít az álláshirdetésekről, hogy megmutassa a különböző IT munkakörök iránti keresletet és fizetési sávokat.',
      },
      {
        name: 'og:image',
        content: 'https://' + environment.domain + '/assets/og-image.jpg',
      },
    ]);

    if (!environment.production) {
      meta.addTag({
        name: 'robots',
        content: 'noindex',
      });
    }
  }

  ngOnInit(): void {
    if (
      this.cookieService.check('cookieconsent_status') &&
      this.cookieService.get('cookieconsent_status') === 'allow'
    ) {
      this.enableTagManager();
    }

    this.statusChangeSubscription = this.ccService.statusChange$.subscribe(
      () => {
        if (this.ccService.hasConsented()) {
          this.enableTagManager();
        }
      }
    );
  }

  async enableTagManager() {
    try {
      await this._ga4.install$(environment.google_measurement_id);
      this._ga4.js();
      this._ga4.config();
    } catch (ex) {
      throw new Error(`Could not load Tag Manager, details: ${ex}`);
    }
  }

  protected readonly environment = environment;
}
