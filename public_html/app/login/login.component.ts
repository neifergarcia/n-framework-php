/**
 * Created by ENESOFTEC on 2/11/2016.
 */

import {Component, Input} from '@angular/core';
import {Http, Headers} from '@angular/http';

import 'rxjs/add/operator/map'

@Component({
    selector: 'login',
    templateUrl: './app/login/login.component.html'
})

export class Login {

    @Input()
    username;
    @Input()
    password;

    public response : string;

    constructor(private http : Http){

    }

    onSubmit() {
        let headers = new Headers();
        headers.append('Content-Type', 'application/x-www-form-urlencoded');

        var body = 'username=' + this.username + '&password=' + this.password;
        this.http
            .post(
                "/login",
                body,
                {headers}
            )
            .map(response => response.json())
            .subscribe(
                response => this.response = response,
                () => console.log('Error Server'),
                () => this.onCompleteResponse()
            );
    }

    private onCompleteResponse(){
        console.log('Response Server', this.response);
        window.location.href = "/";
    }




}

