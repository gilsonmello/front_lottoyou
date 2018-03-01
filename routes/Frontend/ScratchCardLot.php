<?php

Route::resource('scratch_card_lots', 'ScratchCardLotController', [
    'names' => [
        'index' => 'frontend.scratch_card_lots.index',
        'create' => 'frontend.scratch_card_lots.create',
        'store' => 'frontend.scratch_card_lots.store',
        'edit' => 'frontend.scratch_card_lots.edit',
        'update' => 'frontend.scratch_card_lots.update',
        'destroy' => 'frontend.scratch_card_lots.destroy',
        'show' => 'frontend.scratch_card_lots.show'
    ]
]);