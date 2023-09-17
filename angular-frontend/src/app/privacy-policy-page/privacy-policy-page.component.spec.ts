import { ComponentFixture, TestBed } from '@angular/core/testing';

import { PrivacyPolicyPageComponent } from './privacy-policy-page.component';
import { PageHeaderComponent } from '../page-header/page-header.component';

describe('PrivacyPolicyPageComponent', () => {
  let component: PrivacyPolicyPageComponent;
  let fixture: ComponentFixture<PrivacyPolicyPageComponent>;

  beforeEach(() => {
    TestBed.configureTestingModule({
      declarations: [PrivacyPolicyPageComponent, PageHeaderComponent],
    });
    fixture = TestBed.createComponent(PrivacyPolicyPageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
