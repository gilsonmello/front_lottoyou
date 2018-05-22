<?php

Route::post('pagseguro/feedback', 'PaypalController@feedback');
Route::get('pagseguro/get_session_id', 'PagseguroController@sessionId');
Route::post('pagseguro/generate_order', 'PagseguroController@generateOrder');
Route::post('pagseguro/payment', 'PagseguroController@payment');


Route::get('pagseguro/back', 'PaypalController@back');


Route::resource('pagseguro', 'PagseguroController', [
    'names' => [
        'index' => 'frontend.pagseguro.index',
        'create' => 'frontend.pagseguro.create',
        'store' => 'frontend.pagseguro.store',
        'edit' => 'frontend.pagseguro.edit',
        'update' => 'frontend.pagseguro.update',
        'destroy' => 'frontend.pagseguro.destroy',
        'show' => 'frontend.pagseguro.show'
    ],
    'except' => ['show']
]);
