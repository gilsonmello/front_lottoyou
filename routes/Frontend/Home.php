<?php
Route::get('/', 'HomeController@index');
Route::post('/getTranslations/{locale}', 'HomeController@getTranslations');