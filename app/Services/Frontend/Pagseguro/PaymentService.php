<?php namespace App\Services\Frontend\Pagseguro;

use App\BalanceOrder;
use App\User;

/**
 * Created by PhpStorm.
 * User: junnyor
 * Date: 11/12/17
 * Time: 9:21 AM
 */

trait PaymentService
{

    public function getCheckout($request)
    {
        $pagseguro_data = array();

        $pagseguro_data['email'] = 'lottoyou.adm@gmail.com';
        $pagseguro_data['token'] = '0AA8C0B8F9F74F46B9CCB2E7C5D1FFAD';
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