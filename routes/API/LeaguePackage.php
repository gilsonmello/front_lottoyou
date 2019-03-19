<?php
Route::resource('league_packages', 'LeaguePackageController', [
    'names' => [
        'index' => 'api.league_packages.index',
        'create' => 'api.league_packages.create',
        'store' => 'api.league_packages.store',
        'edit' => 'api.league_packages.edit',
        'update' => 'api.league_packages.update',
        'destroy' => 'api.league_packages.destroy',
    ],
    'except' => [
        'show'
    ]
]);

Route::get('league_packages/findBySlug/{slug}', 'LeaguePackageController@findBySlug')
    ->name('api.league_packages.find_by_slug');
    
Route::get('league_packages/find_leagues_by_slug/{slug}', 'LeaguePackageController@findLeaguesBySlug')
    ->name('api.league_packages.find_leagues_by_slug');