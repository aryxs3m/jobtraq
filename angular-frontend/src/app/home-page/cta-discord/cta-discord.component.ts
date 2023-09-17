import {Component, Inject, OnInit, PLATFORM_ID} from '@angular/core';
import {environment} from "../../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {DiscordWidget} from "./dtos/DiscordWidget";
import {DiscordMember} from "./dtos/DiscordMember";
import {isPlatformServer} from "@angular/common";

@Component({
  selector: 'app-cta-discord',
  templateUrl: './cta-discord.component.html',
  styleUrls: ['./cta-discord.component.scss']
})
export class CtaDiscordComponent implements OnInit {

  protected readonly environment = environment;

  members: DiscordMember[] = [];
  private readonly isServer: boolean;

  constructor(private http: HttpClient, @Inject(PLATFORM_ID) platformId: object) {
    this.isServer = isPlatformServer(platformId);
  }

  ngOnInit(): void {
    if (this.isServer) {
      return;
    }

    this.http.get<DiscordWidget>('https://discord.com/api/guilds/'+environment.discord_guild_id+'/widget.json')
      .subscribe((data) => {
        this.members = data.members;
    })
  }


}
