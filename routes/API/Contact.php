<?php

Route::get('contacts/categories', 'ContactController@categories');

Route::resource('contacts', 'ContactController', [
    'names' => [
        'index' => 'api.contacts.index',
        'create' => 'api.contacts.create',
        'store' => 'api.contacts.store',
        'edit' => 'api.contacts.edit',
        'update' => 'api.contacts.update',
        'destroy' => 'api.contacts.destroy',
        'show' => 'api.contacts.show'
    ]
]);

Route::post('contacts/{id}/reply_email', 'ContactController@replyEmail');