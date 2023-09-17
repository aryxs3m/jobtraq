import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class LoaderService {
  private loading = false;
  private backendError = false;

  setLoading(loading: boolean) {
    this.loading = loading;
  }

  getLoading(): boolean {
    return this.loading;
  }

  getBackendError(): boolean {
    return this.backendError;
  }

  setBackendError(backendError: boolean) {
    this.backendError = backendError;
  }
}
