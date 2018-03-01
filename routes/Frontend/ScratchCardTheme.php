<?php

Route::resource('scratch_cards', 'ScratchCardController', [
    'names' => [
        'index' => 'frontend.scratch_cards.index',
        'create' => 'frontend.scratch_cards.create',
        'store' => 'frontend.scratch_cards.store',
        'edit' => 'frontend.scratch_cards.edit',
        'update' => 'frontend.scratch_cards.update',
        'destroy' => 'frontend.scratch_cards.destroy',
        'show' => 'frontend.scratch_cards.show'
    ]
]);