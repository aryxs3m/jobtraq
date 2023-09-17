import {ApplicationRef, Inject, Injectable, PLATFORM_ID} from '@angular/core';
import {SwUpdate, VersionReadyEvent} from "@angular/service-worker";
import {isPlatformBrowser} from "@angular/common";
import {filter, first, interval, Subject, switchMap} from "rxjs";
import {map} from "rxjs/operators";

@Injectable({
  providedIn: 'root'
})
export class UpdateService {
  updateAvailableChange: Subject<boolean> = new Subject<boolean>();
  private updateAvailable = false;

  constructor(
    private swUpdate: SwUpdate,
    @Inject(PLATFORM_ID) platformId: string,
    appRef: ApplicationRef
  ) {
    if (isPlatformBrowser(platformId)) {
      this.updateAvailableChange.subscribe(value => {
        this.updateAvailable = value;
      })

      this.swUpdate.versionUpdates.
        pipe(filter((evt): evt is VersionReadyEvent => evt.type === 'VERSION_READY'),
          map(evt => ({
            type: 'UPDATE_AVAILABLE',
            current: evt.currentVersion,
            available: evt.latestVersion,
          }))).subscribe(() => {
            this.updateAvailableChange.next(true);
      });

      // Poll logic after isStable, otherwise isStable never fires
      appRef.isStable.pipe(
        first(stable => stable),
        switchMap(() => interval(6 * 60 * 60 * 1000)) // Every 6h
      ).subscribe(() => {
        this.swUpdate.checkForUpdate();
      });
    }
  }

  update() {
    window.location.reload();
  }
}
