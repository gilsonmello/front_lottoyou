<?php

Route::resource('soccer_rounds', 'SoccerRoundController', [
    'names' => [
        'index' => 'frontend.soccer_rounds.index',
        'create' => 'frontend.soccer_rounds.create',
        'store' => 'frontend.soccer_rounds.store',
        'edit' => 'frontend.soccer_rounds.edit',
        'update' => 'frontend.soccer_rounds.update',
        'destroy' => 'frontend.soccer_rounds.destroy',
        'show' => 'frontend.soccer_rounds.show'
    ]
]);

Route::get('soccer_rounds/{id}/groups', 'SoccerRoundController@groups');
