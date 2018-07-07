<?php

Route::post('pagseguro/feedback', 'PagseguroController@feedback');
Route::get('pagseguro/get_session_id', 'PagseguroController@sessionId');
Route::post('pagseguro/generate_order', 'PagseguroController@generateOrder');
Route::post('pagseguro/payment', 'PagseguroController@payment');

Route::get('pagseguro/back', 'PagseguroController@back');


Route::resource('pagseguro', 'PagseguroController', [
    'names' => [
        'index' => 'api.pagseguro.index',
        'create' => 'api.pagseguro.create',
        'store' => 'api.pagseguro.store',
        'edit' => 'api.pagseguro.edit',
        'update' => 'api.pagseguro.update',
        'destroy' => 'api.pagseguro.destroy',
        'show' => 'api.pagseguro.show'
    ],
    'except' => ['show']
]);
