import { Component } from '@angular/core';
import {faGithub} from "@fortawesome/free-brands-svg-icons";

@Component({
  selector: 'app-about-page',
  templateUrl: './about-page.component.html',
  styleUrls: ['./about-page.component.scss']
})
export class AboutPageComponent {

  protected readonly faGithub = faGithub;
}
