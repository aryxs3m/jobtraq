import {Component, Input} from '@angular/core';
import {DetailFormatterFunction} from "../../utils/formatter/detail-formatter";

@Component({
  selector: 'app-detail-block',
  templateUrl: './detail-block.component.html',
  styleUrls: ['./detail-block.component.scss']
})
export class DetailBlockComponent {
  @Input() label!: string;
  @Input() value!: string|number;
  @Input() formatter?: DetailFormatterFunction;

  constructor() {
  }

  getValue() {
    if (this.value !== null && this.formatter != null) {
      return this.formatter(this.value);
    }

    return this.value;
  }
}
