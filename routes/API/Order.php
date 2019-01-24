<?php

Route::resource('orders', 'OrderController', [
    'names' => [
        'index' => 'api.orders.index',
        'create' => 'api.orders.create',
        'store' => 'api.orders.store',
        'edit' => 'api.orders.edit',
        'update' => 'api.orders.update',
        'destroy' => 'api.orders.destroy',
        'show' => 'api.orders.show'
    ]
]);

Route::get('orders/{id}/items', 'OrderController@items');
Route::middleware('auth:api')->post('orders/generate_order', 'OrderController@generateOrder');
