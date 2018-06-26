<?php

Route::resource('users', 'UserController', [
    'names' => [
        'index' => 'frontend.users.index',
        'create' => 'frontend.users.create',
        'store' => 'frontend.users.store',
        'edit' => 'frontend.users.edit',
        'update' => 'frontend.users.update',
        'destroy' => 'frontend.users.destroy',
        'show' => 'frontend.users.show'
    ]
]);

Route::get('users/{id}/games', 'UserController@games');
Route::get('users/{id}/transactions', 'UserController@transactions');
Route::get('users/{id}/orders', 'UserController@orders');
Route::get('users/{id}/soccer_experts', 'UserController@soccerExperts');
Route::get('users/{id}/scratch_cards', 'UserController@scratchCards');
Route::get('users/{id}/lotteries', 'UserController@lotteries');
Route::get('users/{id}/items', 'UserController@items');
Route::get('users/{hash}/activate', 'UserController@activate')
    ->name('frontend.users.activate');
Route::get('users/{hash}/activated', 'UserController@activated')
    ->name('frontend.users.activated');