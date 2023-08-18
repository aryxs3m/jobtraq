import {Component, Input, OnInit} from '@angular/core';
import {ArticleListResponse} from "../../network/ArticleListResponse";
import {environment} from "../../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {CommentsResponse} from "../../network/CommentsResponse";
import {NewsBlockItem} from "../../network/NewsBlockItem";
import {LoaderService} from "../../loader.service";
import {Comment} from "../../network/Comment";
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {CommentNewResponse} from "../../network/CommentNewResponse";
import {faExclamationCircle, faInfoCircle} from "@fortawesome/free-solid-svg-icons";

@Component({
  selector: 'app-comments-block',
  templateUrl: './comments-block.component.html',
  styleUrls: ['./comments-block.component.scss']
})
export class CommentsBlockComponent implements OnInit {
  @Input() newsBlock!: NewsBlockItem;
  comments: Comment[] = [];
  loading: boolean = false;

  commentForm = new FormGroup({
    name: new FormControl('', [
      Validators.required,
      Validators.minLength(3),
      Validators.maxLength(32),
    ]),
    message: new FormControl('', [
      Validators.required,
      Validators.minLength(1),
      Validators.maxLength(255),
    ]),
  });

  success: boolean = false;
  fail: boolean = false;

  constructor(private http: HttpClient, private loader: LoaderService) {}


  ngOnInit(): void {
    this.http.get<CommentsResponse>(environment.api_url + 'comments?slug=' + this.newsBlock.slug).subscribe(data => {
      if (data.status === 'error') {
        this.loader.setBackendError(true);

        return;
      }

      this.comments = data.data;
    }, error => {
      this.loader.setBackendError(true);
    })
  }

  postComment() {
    if (this.commentForm.invalid) {
      return;
    }

    this.loading = true;
    this.success = false;
    this.fail = false;

    this.http.post<CommentNewResponse>(environment.api_url + 'comments/new', {
      slug: this.newsBlock.slug,
      name: this.name?.value,
      message: this.message?.value,
    }).subscribe(data => {
      if (data.status === 'success') {
        this.comments.unshift({
          created_at: new Date(),
          message: this.message?.value ?? '',
          name: this.name?.value ?? '',
          is_op: false,
        })

        this.commentForm.reset();
        this.success = true;
        this.loading = false;
      } else {
        this.fail = true;
        this.loading = false;
      }
    })
  }

  get name() {
    return this.commentForm.get('name');
  }

  get message() {
    return this.commentForm.get('message');
  }

  protected readonly faInfoCircle = faInfoCircle;
  protected readonly faExclamationCircle = faExclamationCircle;
}
