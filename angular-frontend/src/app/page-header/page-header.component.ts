import {Component, Input} from '@angular/core';
import {faEnvelope, faGlobe} from "@fortawesome/free-solid-svg-icons";
import {faGithub} from "@fortawesome/free-brands-svg-icons";

@Component({
    selector: 'app-page-header',
    templateUrl: './page-header.component.html',
    styleUrls: ['./page-header.component.scss']
})
export class PageHeaderComponent {
  @Input() title!: string;
  @Input() background: null|string = null;
  protected readonly faEnvelope = faEnvelope;
  protected readonly faGlobe = faGlobe;
  protected readonly faGithub = faGithub;
}
