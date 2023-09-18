import { Component, Input, OnInit } from '@angular/core';
import { NewsBlockItem } from '../../network/NewsBlockItem';
import * as moment from 'moment';

@Component({
  selector: 'app-news-card',
  templateUrl: './news-card.component.html',
  styleUrls: ['./news-card.component.scss'],
})
export class NewsCardComponent implements OnInit {
  @Input() newsBlock!: NewsBlockItem;
  articleLink = '';
  publishDate = '';

  ngOnInit(): void {
    this.articleLink = `/news/${this.newsBlock.slug}`;
    this.publishDate = moment(this.newsBlock.published_at).format('MMM DD');
  }
}
