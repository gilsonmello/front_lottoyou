<?php

Route::resource('soccer_categories', 'SoccerCategoryController', [
    'names' => [
        'index' => 'frontend.soccer_categories.index',
        'create' => 'frontend.soccer_categories.create',
        'store' => 'frontend.soccer_categories.store',
        'edit' => 'frontend.soccer_categories.edit',
        'update' => 'frontend.soccer_categories.update',
        'destroy' => 'frontend.soccer_categories.destroy',
        'show' => 'frontend.soccer_categories.show'
    ]
]);