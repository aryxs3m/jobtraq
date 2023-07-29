import {Component, Input, OnInit} from '@angular/core';
import {HttpClient} from "@angular/common/http";

@Component({
  selector: 'app-status-item',
  templateUrl: './status-item.component.html',
  styleUrls: ['./status-item.component.scss']
})
export class StatusItemComponent {
  @Input() available!: boolean;
  @Input() name!: string;
  @Input() description: string = '';
}
