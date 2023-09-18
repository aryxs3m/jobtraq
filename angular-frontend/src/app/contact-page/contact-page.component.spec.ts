import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ContactPageComponent } from './contact-page.component';
import { PageHeaderComponent } from '../page-header/page-header.component';
import { ContactCardComponent } from './contact-card/contact-card.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';

describe('ContactPageComponent', () => {
  let component: ContactPageComponent;
  let fixture: ComponentFixture<ContactPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [FontAwesomeModule],
      declarations: [
        ContactPageComponent,
        PageHeaderComponent,
        ContactCardComponent,
      ],
    });
    fixture = TestBed.createComponent(ContactPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
