<?php

Route::resource('scratch_card_lots', 'ScratchCardLotController', [
    'names' => [
        'index' => 'api.scratch_card_lots.index',
        'create' => 'api.scratch_card_lots.create',
        'store' => 'api.scratch_card_lots.store',
        'edit' => 'api.scratch_card_lots.edit',
        'update' => 'api.scratch_card_lots.update',
        'destroy' => 'api.scratch_card_lots.destroy',
        'show' => 'api.scratch_card_lots.show'
    ]
]);