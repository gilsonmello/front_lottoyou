<?php

Route::post('recaptcha/check', 'RecaptchaController@check');

Route::resource('recaptcha', 'RecaptchaController', [
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