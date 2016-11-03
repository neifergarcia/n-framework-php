import {Component, NgModule} from '@angular/core';
import {BrowserModule} from "@angular/platform-browser";
import {FormsModule} from "@angular/forms";

import {HttpModule} from '@angular/http';

import {Index} from './index/index.component';
import {Login} from './login/login.component';



@Component({
    selector: 'ene',
    templateUrl: './app/app.component.html'
})

export class AppComponent {
    route = window.location.pathname;
}

@NgModule({
    imports: [BrowserModule, FormsModule, HttpModule],
    declarations: [AppComponent, Index, Login],
    bootstrap: [AppComponent]
})
export class AppModule {}

/*
 Copyright 2016 Google Inc. All Rights Reserved.
 Use of this source code is governed by an MIT-style license that
 can be found in the LICENSE file at http://angular.io/license
 */