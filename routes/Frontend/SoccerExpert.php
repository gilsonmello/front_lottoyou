<?php

Route::resource('soccer_expert', 'SoccerExpertController', [
    'names' => [
        'index' => 'frontend.soccer_expert.index',
        'create' => 'frontend.soccer_expert.create',
        'store' => 'frontend.soccer_expert.store',
        'edit' => 'frontend.soccer_expert.edit',
        'update' => 'frontend.soccer_expert.update',
        'destroy' => 'frontend.soccer_expert.destroy',
        'show' => 'frontend.soccer_expert.show'
    ]
]);