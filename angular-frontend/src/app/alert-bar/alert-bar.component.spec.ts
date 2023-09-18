import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AlertBarComponent } from './alert-bar.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { faCoffee } from '@fortawesome/free-solid-svg-icons';

describe('AlertBarComponent', () => {
  let component: AlertBarComponent;
  let fixture: ComponentFixture<AlertBarComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [FontAwesomeModule],
      declarations: [AlertBarComponent],
    });
    fixture = TestBed.createComponent(AlertBarComponent);
    component = fixture.componentInstance;
  });

  it('should create', () => {
    component.background = '#000000';
    component.icon = faCoffee;

    fixture.detectChanges();
    expect(component).toBeTruthy();
  });
});
