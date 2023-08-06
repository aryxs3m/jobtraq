import {Component} from '@angular/core';
import {environment} from "../../../environments/environment";

@Component({
  selector: 'app-cta-discord',
  templateUrl: './cta-discord.component.html',
  styleUrls: ['./cta-discord.component.scss']
})
export class CtaDiscordComponent {

  protected readonly environment = environment;
}
