<?php

Route::post('users/create_from_facebook', 'UserController@createFromFacebook')
    ->name('api.users.create_from_facebook');

Route::post('users/exists', 'UserController@exists')
    ->name('api.users.exists');

Route::post('users/forgot_password', 'UserController@forgotPassword')
    ->name('api.users.forgot_password');

Route::get('/#/'.config('app.url_locale').'users/password_recovery/{hash}', 'UserController@passwordRecovery')
    ->name('api.users.password_recovery@get');

Route::post('users/password_recovery/{hash}', 'UserController@passwordRecovery')
    ->name('api.users.password_recovery@post');

Route::post('users/check_token_password_recovery/{hash}', 'UserController@checkTokenPasswordRecovery')
    ->name('api.users.check_token_password_recovery');

Route::post('users/check_token_activation/{hash}', 'UserController@checkTokenActivation')
    ->name('api.users.check_token_activation');

Route::post('users/check_token_forgot_password/{hash}', 'UserController@checkTokenForgotPassword')
    ->name('api.users.check_token_forgot_password');

Route::resource('users', 'UserController', [
    'names' => [
        'index' => 'api.users.index',
        'create' => 'api.users.create',
        'store' => 'api.users.store',
        'edit' => 'api.users.edit',
        'update' => 'api.users.update',
        'destroy' => 'api.users.destroy',
        'show' => 'api.users.show'
    ],
    'except' => ['index']
]);

Route::get('users/{id}/games', 'UserController@games');
Route::get('users/{id}/transactions', 'UserController@transactions');
Route::get('users/{id}/orders', 'UserController@orders');
Route::get('users/{id}/soccer_experts', 'UserController@soccerExperts');
Route::get('users/{id}/scratch_cards', 'UserController@scratchCards');
Route::get('users/{id}/lotteries', 'UserController@lotteries');
Route::get('users/{id}/items', 'UserController@items');
Route::get('/#/'.config('app.url_locale').'users/activate/{hash}', 'UserController@activate')
    ->name('api.users.activate@get');
Route::post('users/activate/{hash}', 'UserController@activate')
    ->name('api.users.activate@post');
Route::get('users/{hash}/activated', 'UserController@activated')
    ->name('api.users.activated');

Route::post('users/disable', 'UserController@disable');

