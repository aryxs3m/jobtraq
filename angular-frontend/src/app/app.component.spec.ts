import { TestBed } from '@angular/core/testing';
import { RouterTestingModule } from '@angular/router/testing';
import { AppComponent } from './app.component';
import {
  NgcCookieConsentConfig,
  NgcCookieConsentService,
  WindowService,
} from 'ngx-cookieconsent';
import { ServiceWorkerModule } from '@angular/service-worker';
import { environment } from '../environments/environment';
import { NavbarComponent } from './navbar/navbar.component';
import { UpdateOverlayComponent } from './update-overlay/update-overlay.component';
import { ErrorNotifyComponent } from './error-notify/error-notify.component';
import { FooterComponent } from './footer/footer.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SystemMessageComponent } from './system-message/system-message.component';

describe('AppComponent', () => {
  beforeEach(() =>
    TestBed.configureTestingModule({
      imports: [
        ServiceWorkerModule.register('ngsw-worker.js', {
          enabled: environment.production,
        }),
        RouterTestingModule,
        FontAwesomeModule,
      ],
      declarations: [
        AppComponent,
        NavbarComponent,
        UpdateOverlayComponent,
        ErrorNotifyComponent,
        FooterComponent,
        SystemMessageComponent,
      ],
      providers: [
        NgcCookieConsentService,
        NgcCookieConsentConfig,
        WindowService,
      ],
    })
  );

  it('should create the app', () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    expect(app).toBeTruthy();
  });

  it(`should have as title 'angular-frontend'`, () => {
    const fixture = TestBed.createComponent(AppComponent);
    const app = fixture.componentInstance;
    expect(app.title).toEqual('angular-frontend');
  });
});
