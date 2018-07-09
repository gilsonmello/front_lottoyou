<?php
Route::post('balances/withdraw', 'BalanceController@withdraw');
Route::resource('balances', 'BalanceController', [
    'names' => [
        'index' => 'api.balances.index',
        'create' => 'api.balances.create',
        'store' => 'api.balances.store',
        'edit' => 'api.balances.edit',
        'update' => 'api.balances.update',
        'destroy' => 'api.balances.destroy',
        'show' => 'api.balances.show'
    ],
    'except' => [
        'show'
    ]
]);