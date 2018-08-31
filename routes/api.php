<?php

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\File;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'auth:api', 'namespace' => 'API'], function(){
    Route::get('user', function(Request $request){
    	return User::where('id', '=', $request->user()->id)
    		->where('active', '=', 1)
    		->with('country', 'balance')
    		->get()
    		->first();
    });
});


Route::group(['namespace' => 'API'], function() {
	Route::post('/getTranslations/{locale}', function($locale, Request $request) {
		// copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
        switch ($locale) {
            case 'pt_BR':
                $locale = 'pt_BR';
                break;
            case 'es_ES': {
                $locale = 'es_ES';
                break;
            }
            default:
                $locale = 'en_US';
                break;
        }
        $lang_files = File::files(resource_path() . '/lang/' . $locale);
        $trans = [];
        foreach ($lang_files as $f) {
            $filename = pathinfo($f)['filename'];
            $trans[$filename] = trans($filename);
        }
        return response()->json($trans, 200);
	});
	require __DIR__.'/API/User.php';
	require __DIR__.'/API/ScratchCard.php';
	require __DIR__.'/API/ScratchCardTheme.php';
	require __DIR__.'/API/ScratchCardLot.php';
	require __DIR__.'/API/Country.php';
	require __DIR__.'/API/SoccerExpert.php';
	require __DIR__.'/API/SoccerCategory.php';
	require __DIR__.'/API/Lottery.php';	
	require __DIR__.'/API/Cart.php';
	require __DIR__.'/API/SoccerTicket.php';
	require __DIR__.'/API/SoccerRound.php';
	require __DIR__.'/API/SoccerGroup.php';
	require __DIR__.'/API/Order.php';
	require __DIR__.'/API/HistoricBalance.php';
	require __DIR__.'/API/Pagseguro.php';
	require __DIR__.'/API/Paypal.php';
    require __DIR__.'/API/Contact.php';
    require __DIR__.'/API/Recaptcha.php';
    require __DIR__.'/API/Balance.php';
    require __DIR__.'/API/League.php';
    require __DIR__.'/API/LeaguePackage.php';
    require __DIR__.'/API/Cartola.php';
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
});