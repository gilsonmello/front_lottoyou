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