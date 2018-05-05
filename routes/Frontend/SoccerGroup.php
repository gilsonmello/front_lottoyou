<?php

Route::resource('soccer_groups', 'SoccerGroupController', [
    'names' => [
        'index' => 'frontend.soccer_groups.index',
        'create' => 'frontend.soccer_groups.create',
        'store' => 'frontend.soccer_groups.store',
        'edit' => 'frontend.soccer_groups.edit',
        'update' => 'frontend.soccer_groups.update',
        'destroy' => 'frontend.soccer_groups.destroy',
        'show' => 'frontend.soccer_groups.show'
    ]
]);

Route::get('soccer_groups/{id}/ranking', 'SoccerGroupController@ranking');
Route::get('soccer_groups/{id}/find', 'SoccerGroupController@find');
