import {Component, Input} from '@angular/core';

@Component({
  selector: 'app-status-item',
  templateUrl: './status-item.component.html',
  styleUrls: ['./status-item.component.scss']
})
export class StatusItemComponent {
  @Input() available!: boolean;
  @Input() name!: string;
  @Input() description = '';
}
