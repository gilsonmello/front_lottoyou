<?php
Route::get('/', 'HomeController@index');
Route::post('/', 'HomeController@index');
Route::post('/getTranslations/{locale}', 'HomeController@getTranslations');