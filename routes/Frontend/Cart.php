<?php

Route::post('/carts/add_scratch_cards', 'CartController@addScratchCard')
	->name('frontend.carts.add_scratch_cards');

Route::post('/carts/add_soccer_experts', 'CartController@addSoccerExpert')
    ->name('frontend.carts.add_soccer_experts');

Route::post('/carts/add_lotteries', 'CartController@addLottery')
    ->name('frontend.carts.add_lotteries');

Route::post('/carts/complete_purchase', 'CartController@completePurchase')
    ->name('frontend.carts.complete_purchase');

Route::post('/carts/validate', 'CartController@validatePurchase')
    ->name('frontend.carts.validate');

Route::resource('carts', 'CartController', [
    'names' => [
        'index' => 'frontend.carts.index',
        'create' => 'frontend.carts.create',
        'store' => 'frontend.carts.store',
        'edit' => 'frontend.carts.edit',
        'update' => 'frontend.carts.update',
        'destroy' => 'frontend.carts.destroy',
        'show' => 'frontend.carts.show'
    ]
]);