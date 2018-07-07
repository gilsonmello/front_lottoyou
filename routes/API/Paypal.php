<?php

Route::post('paypal/feedback', 'PaypalController@feedback');
Route::get('paypal/cancel', 'PaypalController@cancel');
Route::post('paypal/payment', 'PaypalController@payment');



Route::resource('paypal', 'PaypalController', [
    'names' => [
        'index' => 'api.paypal.index',
        'create' => 'api.paypal.create',
        'store' => 'api.paypal.store',
        'edit' => 'api.paypal.edit',
        'update' => 'api.paypal.update',
        'destroy' => 'api.paypal.destroy',
        'show' => 'api.paypal.show'
    ],
    'except' => ['show']
]);
