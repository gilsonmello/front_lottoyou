<?php

namespace App\Services\Frontend\Pagseguro;

use App\BalanceOrder;
use App\User;
use App\PagseguroOrder;
use App\Balance;
use App\HistoricBalance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

/**
 * Created by PhpStorm.
 * User: junnyor
 * Date: 11/12/17
 * Time: 9:21 AM
 */

trait PaymentService
{
    public function updateFromPagseguroFeedback($dataXml) 
    {
        //Log::info($resp->results->currencies->USD->buy);

        $pagseguroOrder = new PagseguroOrder;
        $carbon = Carbon::parse($dataXml->date);
        $pagseguroOrder->date = $carbon->toDateTimeString();
        $pagseguroOrder->balance_order_id = $dataXml->reference;
        $carbon = Carbon::parse($dataXml->escrowEndDate);
        $pagseguroOrder->escrowEndDate = $carbon->toDateTimeString();
        $pagseguroOrder->code = $dataXml->code;
        $pagseguroOrder->reference = $dataXml->reference;
        $pagseguroOrder->type = $dataXml->type;
        $pagseguroOrder->status = $dataXml->status;
        $carbon = Carbon::parse($dataXml->lastEventDate);
        $pagseguroOrder->lastEventDate = $carbon->toDateTimeString();
        $pagseguroOrder->paymentMethodType = $dataXml->paymentMethod->type;
        $pagseguroOrder->paymentMethodCode = $dataXml->paymentMethod->code;
        $pagseguroOrder->grossAmount = $dataXml->grossAmount;
        $pagseguroOrder->discountAmount = $dataXml->discountAmount;
        $pagseguroOrder->feeAmount = $dataXml->feeAmount;
        $pagseguroOrder->netAmount = $dataXml->netAmount;
        $pagseguroOrder->extraAmount = $dataXml->extraAmount;
        $pagseguroOrder->installmentCount = $dataXml->installmentCount;
        $pagseguroOrder->itemCount = $dataXml->itemCount;
        
    
        $order = BalanceOrder::find($dataXml->reference); 

        if (in_array($dataXml->status, [1, 2])){
            $order->status_pagseguro = $dataXml->status;
        }
        
        if ($order->date_confirmation == null) {
            $order->date_confirmation = Carbon::now();
        }

        $amount = $order->sub_total;
        
        if (in_array($dataXml->status, [5, 6, 7])
            && ($order->status_pagseguro != 5 && $order->status_pagseguro != 6 && $order->status_pagseguro != 7)) {

            $balance = Balance::where('owner_id', '=', $order->owner_id)->get()->first();

            $historicBalance = new HistoricBalance;
            //$historicBalance->pagseguro_order_id = $pagseguroOrder->id;
            $historicBalance->type = 0;
            $historicBalance->devolution = 1;
            $historicBalance->description = 'Método Pagseguro';
            $historicBalance->modality = 'devolution';
            $historicBalance->context = 'pagseguro_orders';
            $historicBalance->context_message = 'pagseguro.devolution';
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->amount = $amount * -1;
            $historicBalance->system = 1;

            $balance->value -= $amount;
            $balance->value = $balance->value < 0 ? 0 : $balance->value;

            $historicBalance->to = $balance->value;
            $historicBalance->save();

            $pagseguroOrder->historic_balance_id = $historicBalance->id;
            $balance->save();
        }
        //Log::info($order->status_pagseguro, $dataXml->status);

        //Verifico se o pagamento foi aprovado
        if (in_array($dataXml->status, [3, 4]) 
            && ($order->status_pagseguro != 4 && $order->status_pagseguro != 3)) 
        {
            $balance = Balance::where('owner_id', '=', $order->owner_id)->get()->first();

            $historicBalance = new HistoricBalance;
            //$historicBalance->pagseguro_order_id = $pagseguroOrder->id;
            $historicBalance->type = 1;
            $historicBalance->devolution = 0;
            $historicBalance->description = 'Depósito no valor de R$'. $amount .' com o método Pagseguro';
            $historicBalance->modality = 'deposit';
            $historicBalance->context = 'pagseguro_orders';
            $historicBalance->context_message = 'pagseguro.deposit';
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->amount = $amount;
            $historicBalance->system = 1;

            $balance->value += $amount;

            $historicBalance->to = $balance->value;
            $historicBalance->save();

            $pagseguroOrder->historic_balance_id = $historicBalance->id;
            $balance->save();
        }

        $pagseguroOrder->save();
        
        $historicBalance->context_id = $pagseguroOrder->id;
        $historicBalance->save();

        $order->status_pagseguro = $dataXml->status;
        $order->status = $dataXml->status;

        $order->save();
    }

    public function getCheckout($request)
    {
        $pagseguro_data = array();

        $pagseguro_data['email'] = env('PAGSEGURO_EMAIL');
        $pagseguro_data['token'] = env('PAGSEGURO_TOKEN');
        $pagseguro_data['currency'] = 'BRL';


        $order = BalanceOrder::find($request['order_id']);
        $order->total = $request["amount"];
        $order->sub_total = $request["amount"];
        $order->save();

        $order->sub_total = number_format($order->sub_total, 2, '.', '');

        $pagseguro_data['itemId' . 1] = $order->id;
        $pagseguro_data['itemDescription' . 1] = 'transference '.$order->id;
        $pagseguro_data['itemAmount' . 1] = $order->sub_total;
        $pagseguro_data['itemQuantity' . 1] = 1;

        $pagseguro_data['paymentMode'] = "default";
        $pagseguro_data['paymentMethod'] = $request["method"];
        $pagseguro_data['reference'] = $order->id;
        
        $pagseguro_data['notificationURL'] = "";
        //number_format($item->value, 2, '.', '');
        

        $user = User::find($request['owner_id']);

        //dd($user);
        
        //Em produção, mudar para os dados oficiais
        $pagseguro_data['senderName'] = 'Gilson de Melo';
        $pagseguro_data['senderEmail'] = 'c48933974071833692811@sandbox.pagseguro.com.br';


        $pagseguro_data['creditCardHolderName'] = "Gilson de Melo";// $request['card_name'];
        $pagseguro_data['creditCardHolderCPF'] = str_replace('-', '', str_replace('.', '', $request['card_personal_id']));
        $pagseguro_data['creditCardHolderBirthDate'] = $request['card_birth_date'];
        $pagseguro_data['senderCPF'] = str_replace('-', '', str_replace('.', '', $request['card_personal_id']));

      
        $pagseguro_data['shippingAddressRequired'] = false;
        $pagseguro_data['senderRequired'] = false;

        $pagseguro_data['senderPhone'] = "71";
        $pagseguro_data['senderAreaCode'] = "123456789";


        $pagseguro_data['creditCardToken'] = $request['card_token'];
        return $pagseguro_data;
    }
}