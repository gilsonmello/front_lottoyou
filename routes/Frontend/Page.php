<?php
Route::get('/help', 'PageController@help')->name('frontend.pages.help');
Route::get('/privacy', 'PageController@privacy')->name('frontend.pages.privacy');
Route::get('/player_protection', 'PageController@playerProtection')->name('frontend.pages.player_protection');
Route::get('/ask', 'PageController@ask')->name('frontend.pages.ask');
Route::get('/terms', 'PageController@terms')->name('frontend.pages.terms');
Route::get('/register', 'PageController@register')->name('frontend.pages.register');