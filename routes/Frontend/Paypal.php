<?php

Route::post('paypal/feedback', 'PaypalController@feedback');
Route::get('paypal/cancel', 'PaypalController@cancel');
Route::post('paypal/payment', 'PaypalController@payment');



Route::resource('paypal', 'PaypalController', [
    'names' => [
        'index' => 'frontend.paypal.index',
        'create' => 'frontend.paypal.create',
        'store' => 'frontend.paypal.store',
        'edit' => 'frontend.paypal.edit',
        'update' => 'frontend.paypal.update',
        'destroy' => 'frontend.paypal.destroy',
        'show' => 'frontend.paypal.show'
    ],
    'except' => ['show']
]);
