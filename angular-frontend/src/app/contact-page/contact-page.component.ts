import { Component } from '@angular/core';
import { faEnvelope, faGlobe } from '@fortawesome/free-solid-svg-icons';
import { faDiscord, faGithub } from '@fortawesome/free-brands-svg-icons';
import { environment } from '../../environments/environment';

@Component({
  selector: 'app-contact-page',
  templateUrl: './contact-page.component.html',
  styleUrls: ['./contact-page.component.scss'],
})
export class ContactPageComponent {
  protected readonly faGlobe = faGlobe;
  protected readonly faGithub = faGithub;
  protected readonly faEnvelope = faEnvelope;
  protected readonly faDiscord = faDiscord;
  protected readonly environment = environment;
}
