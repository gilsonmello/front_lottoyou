<?php

Route::resource('scratch_cards', 'ScratchCardController', [
    'names' => [
        'index' => 'api.scratch_cards.index',
        'create' => 'api.scratch_cards.create',
        'store' => 'api.scratch_cards.store',
        'edit' => 'api.scratch_cards.edit',
        'update' => 'api.scratch_cards.update',
        'destroy' => 'api.scratch_cards.destroy',
        'show' => 'api.scratch_cards.show'
    ]
]);


Route::get('scratch_cards/{theme_id}/jackpot_available', 'ScratchCardController@jackpotAvailable');