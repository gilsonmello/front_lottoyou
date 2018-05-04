<?php

Route::resource('scratch_card_demo', 'ScratchCardDemoController', [
    'names' => [
        'index' => 'frontend.scratch_card_demo.index',
        'create' => 'frontend.scratch_card_demo.create',
        'store' => 'frontend.scratch_card_demo.store',
        'edit' => 'frontend.scratch_card_demo.edit',
        'update' => 'frontend.scratch_card_demo.update',
        'destroy' => 'frontend.scratch_card_demo.destroy',
        'show' => 'frontend.scratch_card_demo.show'
    ]
]);