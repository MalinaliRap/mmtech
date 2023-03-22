import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class ConstantsService {

    readonly apiUrl: string = 'http://localhost/api/v1';

  constructor() { }
}
