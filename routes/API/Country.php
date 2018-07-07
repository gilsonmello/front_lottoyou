<?php

Route::resource('countries', 'CountryController', [
    'names' => [
        'index' => 'api.countries.index',
        'create' => 'api.countries.create',
        'store' => 'api.countries.store',
        'edit' => 'api.countries.edit',
        'update' => 'api.countries.update',
        'destroy' => 'api.countries.destroy',
        'show' => 'api.countries.show'
    ]
]);