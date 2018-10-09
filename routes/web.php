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

	/*$items = \App\OrderItem::where('type', '=', 'soccer_expert')->get();
	foreach($items as $key => $item) {
		DB::table('order_items')
            ->where('id', $item->id)
            ->update([
                'context_id' => $item->soccer_expert_id
            ]);
	}

	$items = \App\OrderItem::where('type', '=', 'lottery')->get();
	foreach($items as $key => $item) {
		DB::table('order_items')
            ->where('id', $item->id)
            ->update([
                'context_id' => $item->lottery_id
            ]);
	}

	$items = \App\OrderItem::where('type', '=', 'scratch_card')->get();
	foreach($items as $key => $item) {
		DB::table('order_items')
            ->where('id', $item->id)
            ->update([
                'context_id' => $item->scratch_card_id
            ]);
	}

	//Ajustando os registros para order_items
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('order_items', 'historic_balances.id', '=', 'order_items.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 1;
		$historic->modality = 'buy';
		$historic->context = 'order_items';
		$historic->context_message = 'buy';
		$historic->save();
	}

	//Ajustando os registros para soc_apostas
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->whereHas('soccerExpertBet', function($query) {

	})
	->get();
	foreach($historics as $key => $historic) {
		$soccerExpertBet = $historic->soccerExpertBet;
		$round = $historic->soccerExpertBet->round;
		$group = $historic->soccerExpertBet->group;
		$sweepstake = $historic->soccerExpertBet->round->sweepstake;
		$category = $historic->soccerExpertBet->round->category;
		$historic->system = 1;
		$historic->modality = 'award';
		$historic->context = 'soc_apostas';
		$historic->context_message = 'award';
		$historic->description = 'Prêmio no valor de R$'. $historic->amount .'; Grupo = #'.$group->id;
		$historic->description .= '; Rodada = '.$round->nome;
		$historic->description .= '; Bolão = '.$sweepstake->nome;
		$historic->description .= '; Bolão = '.$round->nome;
		$historic->description .= '; Soccer Expert = '.$category->nome;
		$historic->save();
	}

	//Ajustando os registros para lot_users_jogos
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->whereHas('lotteryBet', function($query) {

	})
	->get();

	foreach($historics as $key => $historic) {
		$lotteryBet = $historic->lotteryBet;
		$sweepstake = $historic->lotteryBet->sweepstake;
		$category = $historic->lotteryBet->sweepstake->category;
		$historic->system = 1;
		$historic->modality = 'award';
		$historic->context = 'lot_users_jogos';
		$historic->context_message = 'award';
		$historic->description = 'Prêmio no valor de R$'. $historic->amount;
		$historic->description .= '; Sorteio = '.$sweepstake->sorteio;
		$historic->description .= '; Loteria = '.$category->nome;
		$historic->save();
	}

	//Ajustando os registros para raspadinhas
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->whereHas('scratchCard', function($query) {

	})
	->get();
	foreach($historics as $key => $historic) {
		$scratchCard = $historic->scratchCard;
		$lot = $historic->scratchCard->lot;
		$theme = $historic->scratchCard->theme;
		$historic->system = 1;
		$historic->modality = 'award';
		$historic->context = 'raspadinhas';
		$historic->context_message = 'award';
		$historic->description = 'Prêmio no valor de R$'. $historic->amount;
		$historic->description .= '; Lote = '.$lot->nome;
		$historic->description .= '; Tema = '.$theme->nome;
		$historic->save();
	}

	//Ajustando os registros para pagseguro_orders
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('pagseguro_orders', 'historic_balances.id', '=', 'pagseguro_orders.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 1;
		$historic->modality = 'deposit';
		$historic->context = 'pagseguro_orders';
		$historic->context_message = 'pagseguro deposit';
		$historic->description = 'Depósito no valor de R$'. $historic->amount .' com o método Pagseguro';
		$historic->save();
	}

	//Ajustando os registros para paypal_orders
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('paypal_orders', 'historic_balances.id', '=', 'paypal_orders.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 1;
		$historic->modality = 'deposit';
		$historic->context = 'paypal_orders';
		$historic->context_message = 'paypal deposit';
		$historic->description = 'Depósito no valor de R$'. $historic->amount .' com o método Paypal';
		$historic->save();
	}

	//Ajustando os registros para balance_inserts
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('balance_inserts', 'historic_balances.id', '=', 'balance_inserts.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 1;
		$historic->modality = 'deposit';
		$historic->context = 'balance_inserts';
		$historic->context_message = 'internal deposit';
		$historic->description = 'O sistema interno inseriu R$'. $historic->amount .' no seu saldo';
		$historic->save();
	}

	//Ajustando os registros para agent_withdraw
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('agent_withdraw', 'historic_balances.id', '=', 'agent_withdraw.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 0;
		$historic->modality = 'withdrawal';
		$historic->context = 'agent_withdraw';
		$historic->context_message = 'agent withdrawal';
		$historic->description = 'Saque no valor de R$'. $historic->amount * -1 .' do seu saldo com o método Agente de Pagamento';
		$historic->save();
	}

	//Ajustando os registros para balance_withdraw
	$historics = \App\HistoricBalance::select([
		'historic_balances.*'
	])
	->join('balance_withdraw', 'historic_balances.id', '=', 'balance_withdraw.historic_balance_id')
	->get();
	foreach($historics as $key => $historic) {
		$historic->system = 0;
		$historic->modality = 'withdrawal';
		$historic->context = 'balance_withdraw';
		$historic->context_message = 'internal withdrawal';
		$historic->description = 'O sistema interno removeu R$'. $historic->amount * -1 .' do seu saldo';
		$historic->save();
	}*/

	return view('layouts.frontend.app');
})->name('frontend.home');

//$_SERVER['HTTP_USER_AGENT'] = 'googlebot';

/* if(isset($_SERVER['HTTP_USER_AGENT']) && 
	strstr(strtolower($_SERVER['HTTP_USER_AGENT']), "googlebot"))
{
	Route::group(['namespace' => 'Frontend'], function() {
		require __DIR__.'/Frontend/Home.php';
		require __DIR__.'/Frontend/User.php';
		require __DIR__.'/Frontend/ScratchCard.php';
		require __DIR__.'/Frontend/SoccerExpert.php';
		require __DIR__.'/Frontend/Lottery.php';
        require __DIR__.'/Frontend/Contact.php';
        require __DIR__.'/Frontend/Page.php';
	
		Route::get('/create_your_league', function() {
			return view('frontend.create_your_league');
		})->name('frontend.create_your_league');
	
		Route::get('/how_to_play_easy_money', function() {
			return view('frontend.how_to_play_easy_money');
		})->name('frontend.how_to_play_easy_money');

		Route::get('/how_to_play_soccer_expert', function() {
			return view('frontend.how_to_play_soccer_expert');
		})->name('frontend.how_to_play_soccer_expert');
	});
} */

//Estas rotas serve para renderizar sempre o arquivo app.blade	
Route::get('/{param_1}/{param_2?}', function ($param_1 = null, $param_2 = null, $param_3 = null) {
	return view('layouts.frontend.app');
})
->where('param_2', '(.*)');

Route::get('/'.config('app.url_locale').'users/password_recovery/{hash}', 'UserController@passwordRecovery')
	->name('frontend.users.password_recovery');
	
Route::get('/'.config('app.url_locale').'users/activate/{hash}', 'UserController@activate')
    ->name('frontend.users.activate');
