<?php

Route::resource('order_items', 'OrderController', [
    'names' => [
        'index' => 'frontend.order_items.index',
        'create' => 'frontend.order_items.create',
        'store' => 'frontend.order_items.store',
        'edit' => 'frontend.order_items.edit',
        'update' => 'frontend.order_items.update',
        'destroy' => 'frontend.order_items.destroy',
    ],
    'except' => [
    	'show'
    ]
]);

Route::get('order_items/{id}/items', 'OrderController@items');
