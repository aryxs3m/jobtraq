import { Component } from '@angular/core';
import { faExclamationTriangle } from '@fortawesome/free-solid-svg-icons';
import { LoaderService } from '../loader.service';

@Component({
  selector: 'app-error-notify',
  templateUrl: './error-notify.component.html',
  styleUrls: ['./error-notify.component.scss'],
})
export class ErrorNotifyComponent {
  protected readonly faExclamationTriangle = faExclamationTriangle;

  constructor(public loaderService: LoaderService) {}
}
