<?php

/* Route::post('/carts/complete_fast_payment_lottery', 'CartController@completeFastPaymentLottery')
    ->name('api.carts.complete_fast_payment_lottery'); */

Route::post('/carts/validate_lottery_fast_payment', 'CartController@validateLotteryFastPayment')
    ->name('api.carts.validate_lottery_fast_payment');

/* Route::post('/carts/complete_fast_payment_soccer_expert', 'CartController@completeFastPaymentSoccerExpert')
    ->name('api.carts.complete_fast_payment_soccer_expert'); */

Route::post('/carts/validate_soccer_expert_fast_payment', 'CartController@validateSoccerExpertFastPayment')
    ->name('api.carts.validate_soccer_expert_fast_payment');

Route::post('/carts/add_scratch_cards', 'CartController@addScratchCard')
	->name('api.carts.add_scratch_cards');

Route::post('/carts/add_soccer_experts', 'CartController@addSoccerExpert')
    ->name('api.carts.add_soccer_experts');

Route::post('/carts/add_lotteries', 'CartController@addLottery')
    ->name('api.carts.add_lotteries');

Route::post('/carts/add_cartoleandos', 'CartController@addCartoleando')
    ->name('api.carts.add_cartoleandos');

/* Route::post('/carts/complete_purchase', 'CartController@completePurchase')
    ->name('api.carts.complete_purchase'); */

Route::post('/carts/validate', 'CartController@validatePurchase')
    ->name('api.carts.validate');

Route::resource('carts', 'CartController', [
    'names' => [
        'index' => 'api.carts.index',
        'create' => 'api.carts.create',
        'store' => 'api.carts.store',
        'edit' => 'api.carts.edit',
        'update' => 'api.carts.update',
        'destroy' => 'api.carts.destroy'
    ],
    'except' => [
        'show'
    ]
]);
