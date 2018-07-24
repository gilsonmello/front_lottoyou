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
    ],
    'except' => [
        'show'
    ]
]);

Route::get('lotteries/results/{slug}', 'LotteryController@results')
    ->name('frontend.lotteries.results');
Route::get('lotteries/find/{id}', 'LotteryController@find');
Route::get('lotteries/sweepstakes/{id}', 'LotteryController@sweepstakes');
Route::get('lotteries/sweepstake/{id}', 'LotteryController@sweepstake');
Route::get('lotteries/play/{slug}', 'LotteryController@play')->name('frontend.lotteries.play');