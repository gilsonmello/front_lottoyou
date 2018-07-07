<?php

Route::post('recaptcha/check', 'RecaptchaController@check');

Route::resource('recaptcha', 'RecaptchaController', [
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