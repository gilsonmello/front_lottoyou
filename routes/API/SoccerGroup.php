<?php

Route::resource('soccer_groups', 'SoccerGroupController', [
    'names' => [
        'index' => 'api.soccer_groups.index',
        'create' => 'api.soccer_groups.create',
        'store' => 'api.soccer_groups.store',
        'edit' => 'api.soccer_groups.edit',
        'update' => 'api.soccer_groups.update',
        'destroy' => 'api.soccer_groups.destroy',
        'show' => 'api.soccer_groups.show'
    ]
]);

Route::get('soccer_groups/{id}/ranking', 'SoccerGroupController@ranking');
Route::get('soccer_groups/{id}/find', 'SoccerGroupController@find');
