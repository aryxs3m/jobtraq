import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CtaDiscordComponent } from './cta-discord.component';

describe('CtaDiscordComponent', () => {
  let component: CtaDiscordComponent;
  let fixture: ComponentFixture<CtaDiscordComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [CtaDiscordComponent],
    });
    fixture = TestBed.createComponent(CtaDiscordComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
