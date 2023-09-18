import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ContactCardComponent } from './contact-card.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';

describe('ContactCardComponent', () => {
  let component: ContactCardComponent;
  let fixture: ComponentFixture<ContactCardComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [FontAwesomeModule],
      declarations: [ContactCardComponent],
    });
    fixture = TestBed.createComponent(ContactCardComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.href = 'https://pvga.hu';
    component.icon = faCoffee;
    component.label = 'Website';

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
