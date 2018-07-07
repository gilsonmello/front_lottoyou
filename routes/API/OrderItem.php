<?php

Route::resource('order_items', 'OrderController', [
    'names' => [
        'index' => 'api.order_items.index',
        'create' => 'api.order_items.create',
        'store' => 'api.order_items.store',
        'edit' => 'api.order_items.edit',
        'update' => 'api.order_items.update',
        'destroy' => 'api.order_items.destroy',
    ],
    'except' => [
    	'show'
    ]
]);

Route::get('order_items/{id}/items', 'OrderController@items');
