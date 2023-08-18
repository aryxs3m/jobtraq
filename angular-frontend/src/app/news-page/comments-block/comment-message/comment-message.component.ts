import {Component, Input} from '@angular/core';
import {Comment} from "../../../network/Comment";
import * as moment from "moment";

@Component({
  selector: 'app-comment-message',
  templateUrl: './comment-message.component.html',
  styleUrls: ['./comment-message.component.scss']
})
export class CommentMessageComponent {
  @Input() comment!: Comment;
  protected readonly moment = moment;
  protected readonly encodeURIComponent = encodeURIComponent;
}
