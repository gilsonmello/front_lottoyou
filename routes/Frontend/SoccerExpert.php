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

Route::get('soccer_expert/play/{slug}', 'SoccerExpertController@play')
    ->name('frontend.soccer_expert.play');
Route::get('soccer_expert/results/{slug}', 'SoccerExpertController@results')
    ->name('frontend.soccer_expert.results');
Route::get('soccer_expert/ranks/{slug}', 'SoccerExpertController@ranks')
    ->name('frontend.soccer_expert.ranks');
Route::get('soccer_expert/find/{slug}', 'SoccerExpertController@find')
    ->name('frontend.soccer_expert.find ');
