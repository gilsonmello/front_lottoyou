<?php

use Illuminate\Http\Request;

/*
	!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	Não alterar a ordem das rotas
*/

Route::post('/oauth/token', [
    'uses' => 'CustomAccessTokenController@issueUserToken'
]);

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

/*Route::group(['namespace' => 'Frontend', 'prefix' => 'frontend'], function() {
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
	require __DIR__.'/Frontend/Paypal.php';
    require __DIR__.'/Frontend/Contact.php';
    require __DIR__.'/Frontend/Recaptcha.php';
    Route::get('/quotation_dolar', function() {
		// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'https://api.hgbrasil.com/finance?format=json&key=d58b8e61',
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		// Close request to clear up some resources
		curl_close($curl);

		return $resp;
	});
});*/


//Estas rotas serve para renderizar sempre o arquivo app.blade
Route::get('/', function () {
	return view('layouts.frontend.app');
})->name('frontend.home');

//Estas rotas serve para renderizar sempre o arquivo app.blade	
Route::get('/{param_1}/{param_2?}', function ($param_1) {
	return view('layouts.frontend.app');
})->where('param_2', '(.*)');

//Serve somente para nomear rotas
Route::group(['namespace' => 'Frontend'], function() {
	require __DIR__.'/Frontend/User.php';
});
