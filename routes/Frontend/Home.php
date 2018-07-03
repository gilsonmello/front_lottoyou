<?php
Route::get('/', 'HomeController@index')->name('frontend.home');
Route::post('/', 'HomeController@index');
Route::post('/getTranslations/{locale}', 'HomeController@getTranslations');