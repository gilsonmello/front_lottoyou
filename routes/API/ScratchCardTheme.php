<?php

Route::resource('scratch_card_themes', 'ScratchCardThemeController', [
    'names' => [
        'index' => 'api.scratch_card_themes.index',
        'create' => 'api.scratch_card_themes.create',
        'store' => 'api.scratch_card_themes.store',
        'edit' => 'api.scratch_card_themes.edit',
        'update' => 'api.scratch_card_themes.update',
        'destroy' => 'api.scratch_card_themes.destroy',
        'show' => 'api.scratch_card_themes.show'
    ]
]);
Route::get('scratch_card_themes/{theme_id}/jackpot_available', 'ScratchCardThemeController@jackpotAvailable');
Route::get('scratch_card_themes/{theme_id}/demo', 'ScratchCardThemeController@demo');
Route::get('scratch_card_themes/{theme_id}/scratch_card', 'ScratchCardThemeController@scratchCard');
Route::post('scratch_card_themes/{scratch_card_id}/{theme_id}/change_scratch_card', 'ScratchCardThemeController@changeScratchCard');
Route::get('scratch_card_themes/{theme_id}/play', 'ScratchCardThemeController@play');