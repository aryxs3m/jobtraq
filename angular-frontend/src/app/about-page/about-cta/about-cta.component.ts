import { Component } from '@angular/core';
import { faArrowDown } from '@fortawesome/free-solid-svg-icons';

@Component({
  selector: 'app-about-cta',
  templateUrl: './about-cta.component.html',
  styleUrls: ['./about-cta.component.scss'],
})
export class AboutCtaComponent {
  protected readonly faArrowDown = faArrowDown;
}
