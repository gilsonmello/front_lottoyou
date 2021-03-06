<?php

Route::resource('soccer_experts', 'SoccerExpertController', [
    'names' => [
        'index' => 'api.soccer_experts.index',
        'create' => 'api.soccer_experts.create',
        'store' => 'api.soccer_experts.store',
        'edit' => 'api.soccer_experts.edit',
        'update' => 'api.soccer_experts.update',
        'destroy' => 'api.soccer_experts.destroy',
        'show' => 'api.soccer_experts.show'
    ]
]);

Route::get('soccer_experts/play/{slug}', 'SoccerExpertController@play');
Route::get('soccer_experts/results/{slug}', 'SoccerExpertController@results');
Route::get('soccer_experts/ranks/{slug}', 'SoccerExpertController@ranks');
Route::get('soccer_experts/find/{slug}', 'SoccerExpertController@find');
