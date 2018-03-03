<?php

Route::resource('scratch_card_themes', 'ScratchCardThemeController', [
    'names' => [
        'index' => 'frontend.scratch_card_themes.index',
        'create' => 'frontend.scratch_card_themes.create',
        'store' => 'frontend.scratch_card_themes.store',
        'edit' => 'frontend.scratch_card_themes.edit',
        'update' => 'frontend.scratch_card_themes.update',
        'destroy' => 'frontend.scratch_card_themes.destroy',
        'show' => 'frontend.scratch_card_themes.show'
    ]
]);
Route::get('scratch_card_themes/{theme_id}/jackpot_available', 'ScratchCardThemeController@jackpotAvailable');
Route::get('scratch_card_themes/{theme_id}/demo', 'ScratchCardThemeController@demo');