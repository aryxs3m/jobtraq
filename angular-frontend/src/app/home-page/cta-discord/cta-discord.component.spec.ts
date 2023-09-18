import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CtaDiscordComponent } from './cta-discord.component';
import { HttpClientTestingModule } from '@angular/common/http/testing';
import { SmallDividerComponent } from '../../small-divider/small-divider.component';

describe('CtaDiscordComponent', () => {
  let component: CtaDiscordComponent;
  let fixture: ComponentFixture<CtaDiscordComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule],
      declarations: [CtaDiscordComponent, SmallDividerComponent],
    });
    fixture = TestBed.createComponent(CtaDiscordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
