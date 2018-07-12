<?php
Route::post('balances/agent_withdraw', 'BalanceController@agentWithdraw');
Route::post('balances/paypal_withdraw', 'BalanceController@paypalWithdraw');
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