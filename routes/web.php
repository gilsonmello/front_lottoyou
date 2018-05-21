<?php
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['namespace' => 'Frontend'], function() {
	require __DIR__.'/Frontend/Home.php';
	require __DIR__.'/Frontend/User.php';
	require __DIR__.'/Frontend/ScratchCard.php';
	require __DIR__.'/Frontend/ScratchCardTheme.php';
	require __DIR__.'/Frontend/ScratchCardLot.php';
	require __DIR__.'/Frontend/Country.php';
	require __DIR__.'/Frontend/SoccerExpert.php';
	require __DIR__.'/Frontend/SoccerCategory.php';
	require __DIR__.'/Frontend/Lottery.php';	
	require __DIR__.'/Frontend/Cart.php';
	require __DIR__.'/Frontend/SoccerTicket.php';
	require __DIR__.'/Frontend/SoccerRound.php';
	require __DIR__.'/Frontend/SoccerGroup.php';
	require __DIR__.'/Frontend/Order.php';
	require __DIR__.'/Frontend/HistoricBalance.php';
	require __DIR__.'/Frontend/Pagseguro.php';
});
