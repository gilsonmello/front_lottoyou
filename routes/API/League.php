<?php

Route::get('leagues/awards/{slug}', 'LeagueController@awards')
    ->name('api.leagues.awards');

Route::get('/leagues/{slug}/classic/teams', 'LeagueController@classicTeams')
    ->name('api.leagues.classic.teams');

Route::get('/leagues/{slug}/cup/teams', 'LeagueController@cupTeams')
    ->name('api.leagues.cup.teams');

Route::resource('leagues', 'LeagueController', [
    'names' => [
        'index' => 'api.leagues.index',
        'create' => 'api.leagues.create',
        'store' => 'api.leagues.store',
        'edit' => 'api.leagues.edit',
        'update' => 'api.leagues.update',
        'destroy' => 'api.leagues.destroy',
    ]
]);