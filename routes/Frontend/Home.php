<?php

/* Route::get('/', function () {
    return File::get(public_path() . '/index.html');
})->name('frontend.home'); */
Route::get('/', 'HomeController@index')->name('frontend.home');
Route::post('/', 'HomeController@index');
Route::post('/getTranslations/{locale}', 'HomeController@getTranslations');