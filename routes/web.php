<?php
Route::get('/','TipController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/verify/links/confirmation/{token}', 'EmailController@Verify')->name('verifyLink');

