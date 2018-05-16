<?php

Route::resource('soccer_tickets', 'SoccerTicketController', [
    'names' => [
        'index' => 'frontend.soccer_tickets.index',
        'create' => 'frontend.soccer_tickets.create',
        'store' => 'frontend.soccer_tickets.store',
        'edit' => 'frontend.soccer_tickets.edit',
        'update' => 'frontend.soccer_tickets.update',
        'destroy' => 'frontend.soccer_tickets.destroy',
        'show' => 'frontend.soccer_tickets.show'
    ]
]);

Route::get('soccer_tickets/{ticket_id}/games', 'SoccerTicketController@games');
