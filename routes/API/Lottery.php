<?php

Route::resource('lotteries', 'LotteryController', [
    'names' => [
        'index' => 'api.lotteries.index',
        'create' => 'api.lotteries.create',
        'store' => 'api.lotteries.store',
        'edit' => 'api.lotteries.edit',
        'update' => 'api.lotteries.update',
        'destroy' => 'api.lotteries.destroy',
        'show' => 'api.lotteries.show'
    ]
]);

Route::get('lotteries/results/{id}', 'LotteryController@results');
Route::get('lotteries/find/{id}', 'LotteryController@find');
Route::get('lotteries/sweepstakes/{id}', 'LotteryController@sweepstakes');
Route::get('lotteries/sweepstake/{id}', 'LotteryController@sweepstake');