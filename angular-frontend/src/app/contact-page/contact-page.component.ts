import { Component } from '@angular/core';
import {faEnvelope, faGlobe} from "@fortawesome/free-solid-svg-icons";
import {faGithub} from "@fortawesome/free-brands-svg-icons";

@Component({
  selector: 'app-contact-page',
  templateUrl: './contact-page.component.html',
  styleUrls: ['./contact-page.component.scss']
})
export class ContactPageComponent {

  protected readonly faGlobe = faGlobe;
  protected readonly faGithub = faGithub;
  protected readonly faEnvelope = faEnvelope;
}
