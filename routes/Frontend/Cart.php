<?php

Route::resource('carts', 'CartController', [
    'names' => [
        'index' => 'frontend.carts.index',
        'create' => 'frontend.carts.create',
        'store' => 'frontend.carts.store',
        'edit' => 'frontend.carts.edit',
        'update' => 'frontend.carts.update',
        'destroy' => 'frontend.carts.destroy',
        'show' => 'frontend.carts.show'
    ]
]);