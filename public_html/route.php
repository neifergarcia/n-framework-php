<?php

//Index

Route::get('/', 'IndexController@index');
Route::get('/index', 'IndexController@index');
Route::get('/login', 'IndexController@showLogin');

Route::get('/logout', 'LoginController@logout', true);
Route::post('/login', 'LoginController@login', true);

Route::validateUri(); //Validater Uris