<?php

Route::resource('scratch_card_demo', 'ScratchCardDemoController', [
    'names' => [
        'index' => 'api.scratch_card_demo.index',
        'create' => 'api.scratch_card_demo.create',
        'store' => 'api.scratch_card_demo.store',
        'edit' => 'api.scratch_card_demo.edit',
        'update' => 'api.scratch_card_demo.update',
        'destroy' => 'api.scratch_card_demo.destroy',
        'show' => 'api.scratch_card_demo.show'
    ]
]);