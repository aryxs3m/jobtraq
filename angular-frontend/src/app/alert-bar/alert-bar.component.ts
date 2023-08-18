import {Component, Input} from '@angular/core';
import {IconDefinition} from "@fortawesome/fontawesome-svg-core";
import {faInfoCircle} from "@fortawesome/free-solid-svg-icons";

@Component({
  selector: 'app-alert-bar',
  templateUrl: './alert-bar.component.html',
  styleUrls: ['./alert-bar.component.scss']
})
export class AlertBarComponent {
  @Input() icon!: IconDefinition;
  @Input() background!: string;
}
