<?php

Route::resource('lotteries', 'LotteryController', [
    'names' => [
        'index' => 'frontend.lotteries.index',
        'create' => 'frontend.lotteries.create',
        'store' => 'frontend.lotteries.store',
        'edit' => 'frontend.lotteries.edit',
        'update' => 'frontend.lotteries.update',
        'destroy' => 'frontend.lotteries.destroy',
        'show' => 'frontend.lotteries.show'
    ]
]);

Route::get('lotteries/results/{id}', 'LotteryController@results');
Route::get('lotteries/find/{id}', 'LotteryController@find');
Route::get('lotteries/sweepstakes/{id}', 'LotteryController@sweepstakes');