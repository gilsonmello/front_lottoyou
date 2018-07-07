<?php
Route::get('/', 'HomeController@index')->name('api.home');

/*Route::get('/', function () {
    return File::get(public_path() . '/index.html');
});*/

Route::post('/', 'HomeController@index');
Route::post('/getTranslations/{locale}', 'HomeController@getTranslations');