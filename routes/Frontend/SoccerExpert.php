<?php

Route::resource('soccer_experts', 'SoccerExpertController', [
    'names' => [
        'index' => 'frontend.soccer_experts.index',
        'create' => 'frontend.soccer_experts.create',
        'store' => 'frontend.soccer_experts.store',
        'edit' => 'frontend.soccer_experts.edit',
        'update' => 'frontend.soccer_experts.update',
        'destroy' => 'frontend.soccer_experts.destroy',
        'show' => 'frontend.soccer_experts.show'
    ]
]);