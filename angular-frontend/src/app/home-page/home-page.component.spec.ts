import { ComponentFixture, TestBed } from '@angular/core/testing';

import { HomePageComponent } from './home-page.component';
import { HttpClientTestingModule } from '@angular/common/http/testing';
import { RouterTestingModule } from '@angular/router/testing';
import { AboutCtaComponent } from '../about-page/about-cta/about-cta.component';
import { NoDataInfoComponent } from './no-data-info/no-data-info.component';
import { NewsBlockComponent } from '../news-block/news-block.component';
import { CtaDiscordComponent } from './cta-discord/cta-discord.component';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { SmallDividerComponent } from '../small-divider/small-divider.component';
import { SkeletonNewsCardComponent } from '../news-block/skeleton-news-card/skeleton-news-card.component';
import { NgxSkeletonLoaderModule } from 'ngx-skeleton-loader';

describe('HomePageComponent', () => {
  let component: HomePageComponent;
  let fixture: ComponentFixture<HomePageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [
        HttpClientTestingModule,
        RouterTestingModule,
        FontAwesomeModule,
        NgxSkeletonLoaderModule,
      ],
      declarations: [
        HomePageComponent,
        AboutCtaComponent,
        NoDataInfoComponent,
        NewsBlockComponent,
        CtaDiscordComponent,
        SmallDividerComponent,
        SkeletonNewsCardComponent,
      ],
    });
    fixture = TestBed.createComponent(HomePageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
