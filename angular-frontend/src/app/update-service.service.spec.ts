import { TestBed } from '@angular/core/testing';

import { UpdateService } from './update.service';
import { ServiceWorkerModule } from '@angular/service-worker';
import { environment } from '../environments/environment';

describe('UpdateServiceService', () => {
  let service: UpdateService;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        ServiceWorkerModule.register('ngsw-worker.js', {
          enabled: environment.production,
        }),
      ],
    });
    service = TestBed.inject(UpdateService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
