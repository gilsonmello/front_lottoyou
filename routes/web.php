<?php

use Illuminate\Http\Request;
use App\Lottery;
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
	/* $historics = \App\HistoricBalance::whereNotNull('paypal_order_id')->get();

	foreach($historics as $key => $historic) {

		\DB::table('paypal_orders')
            ->where('id', $historic->paypal_order_id)
			->update(['historic_balance_id' => $historic->id]);
	} */
	return view('layouts.frontend.app');
})->name('frontend.home');

//$_SERVER['HTTP_USER_AGENT'] = 'googlebot';

if(isset($_SERVER['HTTP_USER_AGENT']) && 
	strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot"))
{
	Route::group(['namespace' => 'Frontend'], function() {
		require __DIR__.'/Frontend/Home.php';
		require __DIR__.'/Frontend/User.php';
		require __DIR__.'/Frontend/ScratchCard.php';
		require __DIR__.'/Frontend/SoccerExpert.php';
		require __DIR__.'/Frontend/Lottery.php';
	
		Route::get('/create_your_league', function() {
			return view('frontend.create_your_league');
		})->name('frontend.create_your_league');
	
		Route::get('/how_to_play_easy_moneyhow_to_play_easy_money', function() {
			return view('frontend.how_to_play_easy_money');
		})->name('frontend.how_to_play_easy_money');
	});
}

//Estas rotas serve para renderizar sempre o arquivo app.blade	
Route::get('/{param_1}/{param_2?}', function ($param_1 = null, $param_2 = null, $param_3 = null) {
	return view('layouts.frontend.app', compact('seo'));
})
->where('param_2', '(.*)');
