import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AboutPageComponent } from './about-page.component';
import { SmallDividerComponent } from '../small-divider/small-divider.component';
import { PageHeaderComponent } from '../page-header/page-header.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';

describe('AboutPageComponent', () => {
  let component: AboutPageComponent;
  let fixture: ComponentFixture<AboutPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [FontAwesomeModule],
      declarations: [
        AboutPageComponent,
        PageHeaderComponent,
        SmallDividerComponent,
      ],
    });
    fixture = TestBed.createComponent(AboutPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
