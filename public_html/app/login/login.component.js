/**
 * Created by ENESOFTEC on 2/11/2016.
 */
"use strict";
var __decorate = (this && this.__decorate) || function (decorators, target, key, desc) {
    var c = arguments.length, r = c < 3 ? target : desc === null ? desc = Object.getOwnPropertyDescriptor(target, key) : desc, d;
    if (typeof Reflect === "object" && typeof Reflect.decorate === "function") r = Reflect.decorate(decorators, target, key, desc);
    else for (var i = decorators.length - 1; i >= 0; i--) if (d = decorators[i]) r = (c < 3 ? d(r) : c > 3 ? d(target, key, r) : d(target, key)) || r;
    return c > 3 && r && Object.defineProperty(target, key, r), r;
};
var __metadata = (this && this.__metadata) || function (k, v) {
    if (typeof Reflect === "object" && typeof Reflect.metadata === "function") return Reflect.metadata(k, v);
};
var core_1 = require('@angular/core');
var http_1 = require('@angular/http');
require('rxjs/add/operator/map');
var Login = (function () {
    function Login(http) {
        this.http = http;
    }
    Login.prototype.onSubmit = function () {
        var _this = this;
        var headers = new http_1.Headers();
        headers.append('Content-Type', 'application/x-www-form-urlencoded');
        var body = 'username=' + this.username + '&password=' + this.password;
        this.http
            .post("/login", body, { headers: headers })
            .map(function (response) { return response.json(); })
            .subscribe(function (response) { return _this.response = response; }, function () { return console.log('Error Server'); }, function () { return _this.onCompleteResponse(); });
    };
    Login.prototype.onCompleteResponse = function () {
        console.log('Response Server', this.response);
        window.location.href = "/";
    };
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Object)
    ], Login.prototype, "username", void 0);
    __decorate([
        core_1.Input(), 
        __metadata('design:type', Object)
    ], Login.prototype, "password", void 0);
    Login = __decorate([
        core_1.Component({
            selector: 'login',
            templateUrl: './app/login/login.component.html'
        }), 
        __metadata('design:paramtypes', [http_1.Http])
    ], Login);
    return Login;
}());
exports.Login = Login;
//# sourceMappingURL=login.component.js.map