import { ComponentFixture, TestBed } from '@angular/core/testing';

import { UpdateOverlayComponent } from './update-overlay.component';
import { ServiceWorkerModule } from '@angular/service-worker';
import { environment } from '../../environments/environment';

describe('UpdateOverlayComponent', () => {
  let component: UpdateOverlayComponent;
  let fixture: ComponentFixture<UpdateOverlayComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        ServiceWorkerModule.register('ngsw-worker.js', {
          enabled: environment.production,
        }),
      ],
      declarations: [UpdateOverlayComponent],
    });
    fixture = TestBed.createComponent(UpdateOverlayComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
