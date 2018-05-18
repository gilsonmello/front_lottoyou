<?php

Route::resource('historic_balances', 'HistoricBalanceController', [
    'names' => [
        'index' => 'frontend.historic_balances.index',
        'create' => 'frontend.historic_balances.create',
        'store' => 'frontend.historic_balances.store',
        'edit' => 'frontend.historic_balances.edit',
        'update' => 'frontend.historic_balances.update',
        'destroy' => 'frontend.historic_balances.destroy',
        'show' => 'frontend.historic_balances.show'
    ]
]);

Route::get('historic_balances/find/{id}', 'HistoricBalanceController@find');
Route::get('historic_balances/of_the_user/{id}', 'HistoricBalanceController@ofTheUser');