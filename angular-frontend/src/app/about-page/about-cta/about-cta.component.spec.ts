import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AboutCtaComponent } from './about-cta.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';

describe('AboutCtaComponent', () => {
  let component: AboutCtaComponent;
  let fixture: ComponentFixture<AboutCtaComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [FontAwesomeModule],
      declarations: [AboutCtaComponent],
    });
    fixture = TestBed.createComponent(AboutCtaComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
