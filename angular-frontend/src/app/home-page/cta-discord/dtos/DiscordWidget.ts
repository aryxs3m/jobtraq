import { DiscordMember } from './DiscordMember';

export interface DiscordWidget {
  channels: [];
  id: string;
  instant_invite?: boolean;
  members: DiscordMember[];
  name: string;
  presence_count: number;
}
