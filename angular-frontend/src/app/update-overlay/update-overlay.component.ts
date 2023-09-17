import {Component} from '@angular/core';
import {UpdateService} from "../update.service";

@Component({
  selector: 'app-update-overlay',
  templateUrl: './update-overlay.component.html',
  styleUrls: ['./update-overlay.component.scss']
})
export class UpdateOverlayComponent {

  visible = false;

  constructor(private updateService: UpdateService) {
    updateService.updateAvailableChange.subscribe(value => {
      this.visible = value;
    })
  }

  update() {
    this.updateService.update();
  }
}
