<?php

Route::resource('soccer_rounds', 'SoccerRoundController', [
    'names' => [
        'index' => 'api.soccer_rounds.index',
        'create' => 'api.soccer_rounds.create',
        'store' => 'api.soccer_rounds.store',
        'edit' => 'api.soccer_rounds.edit',
        'update' => 'api.soccer_rounds.update',
        'destroy' => 'api.soccer_rounds.destroy',
        'show' => 'api.soccer_rounds.show'
    ]
]);

Route::get('soccer_rounds/{id}/groups', 'SoccerRoundController@groups');
