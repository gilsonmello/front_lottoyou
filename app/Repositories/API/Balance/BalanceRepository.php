<?php
/**
 * Created by PhpStorm.
 * User: gilsonmello
 * Date: 6/25/18
 * Time: 6:05 PM
 */

namespace App\Repositories\API\Balance;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Balance;
use App\HistoricBalance;
use App\BalanceWithdraw;
use App\AgentWithdraw;
use App\PaypalWithdraw;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class BalanceRepository implements BalanceContract
{
    /**
     * @param $request
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function paypalWithdraw($request)
    {
        $client = new Client();
        $res = $client->request('post', 'https://svcs.sandbox.paypal.com/AdaptivePayments/Pay', [
            'headers' => [
                'X-PAYPAL-SECURITY-USERID' => env('PAYPAL_SECURITY_USER_ID'),
                'X-PAYPAL-SECURITY-PASSWORD' => env('PAYPAL_SECURITY_PASSWORD'),
                'X-PAYPAL-SECURITY-SIGNATURE' => env('PAYPAL_SECURITY_SIGNATURE'),
                'X-PAYPAL-REQUEST-DATA-FORMAT' => 'NV',
                'X-PAYPAL-RESPONSE-DATA-FORMAT' => 'NV',
                'X-PAYPAL-APPLICATION-ID' => env('PAYPAL_APPLICATION_ID'),
            ],
            'form_params' => [
                'actionType' => 'PAY',
                'senderEmail' => 'lottoyou.adm-facilitator@gmail.com',
                'currencyCode' => 'USD',
                'receiverList' => [
                    'receiver' => [
                        [
                            'amount' => '1.00',
                            'email' => 'junnyorr.sirnandes@gmail.com',
                        ],
                    ],
                ],
                'returnUrl' => 'http://localhost:8000',
                'cancelUrl' => 'http://localhost:8000',
                'requestEnvelope' => [
                    'errorLanguage' => 'en_US',
                    'detailLevel' => 'ReturnAll'
                ]
            ]
        ]);



        return $res->getBody()->getContents();


        /* DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            $user = User::findOrFail($request->owner_id);

            $balance = Balance::where('owner_id', '=', $user->id)->get()->first();
            
            $historicBalance = new HistoricBalance;
            $historicBalance->owner_id = $user->id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->type = 0;
            $historicBalance->description = 'paypal withdrawal';
            
            $balanceWithdraw = new BalanceWithdraw;
            $balanceWithdraw->owner_id = $user->id;
            $balanceWithdraw->value = $request->value;
            $balanceWithdraw->country_id = $request->country_id;
            $balanceWithdraw->name = $request->name;
            $balanceWithdraw->bank = $request->bank;
            $balanceWithdraw->agency = $request->agency;
            $balanceWithdraw->number = $request->number;
            $balanceWithdraw->account_type = $request->account_type;            
            $balanceWithdraw->identification = $request->identification;
            $balanceWithdraw->operation = $request->operation;
            $balanceWithdraw->finish = 0;
            $balanceWithdraw->save();
            
            $balance->value -= $request->value;
            $balance->save();

            $historicBalance->paypal_withdraw_id = $agentWithdraw->id;
            $historicBalance->amount = $request->value * -1; 
            $historicBalance->to = $balance->value;
            $historicBalance->save();

            DB::commit();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            return false;
        } catch (\PDOException $e) {
            DB::rollBack();
            return false;
        }
        return false; */
    }

    /**
     * @param $request
     */
    public function agentWithdraw($request)
    {
        DB::beginTransaction();

        //Caso ocorra algum erro de SQL, é feito o rollback
        try {
            $user = User::findOrFail($request->owner_id);

            $balance = Balance::where('owner_id', '=', $user->id)->get()->first();
            
            $historicBalance = new HistoricBalance;
            $historicBalance->owner_id = $user->id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->type = 0;
            $historicBalance->description = 'agent withdrawal';  

            //$historicBalance->agent_withdraw_id = $agentWithdraw->id;
            $historicBalance->amount = $request->value * -1; 
            $historicBalance->to = $balance->value;
            $historicBalance->save();          
            

            $balanceWithdraw = new BalanceWithdraw;
            $balanceWithdraw->owner_id = $user->id;
            $balanceWithdraw->value = $request->value;
            $balanceWithdraw->finish = 0;
            $balanceWithdraw->status = 1;
            $balanceWithdraw->save();

            $agentWithdraw = new AgentWithdraw;
            $agentWithdraw->value = $request->value;
            $agentWithdraw->country_id = $request->country_id;
            $agentWithdraw->name = $request->name;
            $agentWithdraw->bank = $request->bank;
            $agentWithdraw->agency = $request->agency;
            $agentWithdraw->number = $request->number;
            $agentWithdraw->message = null;
            $agentWithdraw->account_type = $request->account_type;            
            $agentWithdraw->identification = $request->identification;
            $agentWithdraw->operation = $request->operation;
            $agentWithdraw->finish = 0;
            $agentWithdraw->withdraw_id = $balanceWithdraw->id;
            $agentWithdraw->owner_id = $user->id;
            $agentWithdraw->historic_balance_id = $historicBalance->id;
            $agentWithdraw->save();
            
            $balance->value -= $request->value;
            $balance->save();

            DB::commit();
            return true;
        } catch (\Illuminate\Database\QueryException $e) {
            dd($e->getMessage());
            DB::rollBack();
            return false;
        } catch (\PDOException $e) {
            DB::rollBack();
            return false;
        }
        return false;
    }

    /**
     * @param Request $request
     * @return bool|mixed
     */
    public function create(Request $request)
    {
        
    }

    /**
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update($id, array $attributes)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }
}