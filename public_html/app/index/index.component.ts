/**
 * Created by ENESOFTEC on 2/11/2016.
 */
import {Component} from '@angular/core';
import {Http} from "@angular/http";

@Component({
    selector: 'index',
    templateUrl: './app/index/index.component.html'
})

export class Index {
    name = "N-Framework PHP with Angular 2";
    developer = "ENE Software & Tecnología";

    private response;

    constructor(private http: Http){

    }

    onLogout(){
        this.http
            .get("/logout")
            .map(response => response.json())
            .subscribe(
                response => this.response = response,
                () => console.log('Error Server'),
                () => this.onCompleteResponse()
            )
    }

    private onCompleteResponse(){
        console.log('Response Server', this.response);
        window.location.href = "/";
    }
}
