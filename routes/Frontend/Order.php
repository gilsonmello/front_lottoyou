<?php

Route::resource('orders', 'OrderController', [
    'names' => [
        'index' => 'frontend.orders.index',
        'create' => 'frontend.orders.create',
        'store' => 'frontend.orders.store',
        'edit' => 'frontend.orders.edit',
        'update' => 'frontend.orders.update',
        'destroy' => 'frontend.orders.destroy',
        'show' => 'frontend.orders.show'
    ]
]);

Route::get('orders/{id}/items', 'OrderController@items');
Route::post('orders/generate_order', 'OrderController@generateOrder');
