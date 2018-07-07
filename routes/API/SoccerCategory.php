<?php

Route::resource('soccer_categories', 'SoccerCategoryController', [
    'names' => [
        'index' => 'api.soccer_categories.index',
        'create' => 'api.soccer_categories.create',
        'store' => 'api.soccer_categories.store',
        'edit' => 'api.soccer_categories.edit',
        'update' => 'api.soccer_categories.update',
        'destroy' => 'api.soccer_categories.destroy',
        'show' => 'api.soccer_categories.show'
    ]
]);