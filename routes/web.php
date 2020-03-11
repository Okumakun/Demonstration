<?php

Auth::routes();

Route::get('/', 'WEB\TipController@index')->name('index');

Route::get('/home', 'HomeController@index')->name('home');
