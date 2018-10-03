<?php

Route::resource('historic_balances', 'HistoricBalanceController', [
    'names' => [
        'index' => 'api.historic_balances.index',
        'create' => 'api.historic_balances.create',
        'store' => 'api.historic_balances.store',
        'edit' => 'api.historic_balances.edit',
        'update' => 'api.historic_balances.update',
        'destroy' => 'api.historic_balances.destroy',
        'show' => 'api.historic_balances.show'
    ]
]);

Route::get('historic_balances/find/{id}', 'HistoricBalanceController@find');
