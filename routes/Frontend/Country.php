<?php

Route::resource('countries', 'CountryController', [
    'names' => [
        'index' => 'frontend.countries.index',
        'create' => 'frontend.countries.create',
        'store' => 'frontend.countries.store',
        'edit' => 'frontend.countries.edit',
        'update' => 'frontend.countries.update',
        'destroy' => 'frontend.countries.destroy',
        'show' => 'frontend.countries.show'
    ]
]);