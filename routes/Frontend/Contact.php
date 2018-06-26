<?php

Route::get('contacts/categories', 'ContactController@categories');

Route::resource('contacts', 'ContactController', [
    'names' => [
        'index' => 'frontend.contacts.index',
        'create' => 'frontend.contacts.create',
        'store' => 'frontend.contacts.store',
        'edit' => 'frontend.contacts.edit',
        'update' => 'frontend.contacts.update',
        'destroy' => 'frontend.contacts.destroy',
        'show' => 'frontend.contacts.show'
    ]
]);