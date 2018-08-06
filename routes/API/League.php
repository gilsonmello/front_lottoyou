<?php
Route::get('leagues/awards/{slug}', 'LeagueController@awards')
    ->name('api.leagues.awards');
Route::resource('leagues', 'LeagueController', [
    'names' => [
        'index' => 'api.leagues.index',
        'create' => 'api.leagues.create',
        'store' => 'api.leagues.store',
        'edit' => 'api.leagues.edit',
        'update' => 'api.leagues.update',
        'destroy' => 'api.leagues.destroy',
    ],
    'except' => [
        'show'
    ]
]);