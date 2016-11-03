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
/**
 * Created by ENESOFTEC on 2/11/2016.
 */
var core_1 = require('@angular/core');
var http_1 = require("@angular/http");
var Index = (function () {
    function Index(http) {
        this.http = http;
        this.name = "N-Framework PHP with Angular 2";
        this.developer = "ENE Software & Tecnología";
    }
    Index.prototype.onLogout = function () {
        var _this = this;
        this.http
            .get("/logout")
            .map(function (response) { return response.json(); })
            .subscribe(function (response) { return _this.response = response; }, function () { return console.log('Error Server'); }, function () { return _this.onCompleteResponse(); });
    };
    Index.prototype.onCompleteResponse = function () {
        console.log('Response Server', this.response);
        window.location.href = "/";
    };
    Index = __decorate([
        core_1.Component({
            selector: 'index',
            templateUrl: './app/index/index.component.html'
        }), 
        __metadata('design:paramtypes', [http_1.Http])
    ], Index);
    return Index;
}());
exports.Index = Index;
//# sourceMappingURL=index.component.js.map