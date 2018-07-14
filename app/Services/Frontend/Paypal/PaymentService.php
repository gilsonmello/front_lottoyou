<?php

namespace App\Services\Frontend\Paypal;

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

        $pagseguro_data['rm'] = 2;
        $pagseguro_data['cmd'] = '_xclick';
        $pagseguro_data['invoice'] = $request['order_id'];


        $order = BalanceOrder::find($request['order_id']);
        $order->total = $request["amount"];
        $order->sub_total = $request["amount"];
        $order->save();

        $order->sub_total = number_format($order->sub_total, 2, '.', '');

        $pagseguro_data['item_name'] = 'Transference '.$request->order_id;
        $pagseguro_data['quantity'] = 1;

        $pagseguro_data['upload'] = 1;
        $pagseguro_data['business'] = 'lottoyou.adm-facilitator@gmail.com';
        $pagseguro_data['return'] = 'https://lottoyou.bet';
        
        $pagseguro_data['cancel'] = "https://lottoyou.bet/cancel";
        //number_format($item->value, 2, '.', '');
        
        
        //Em produção, mudar para os dados oficiais
        $pagseguro_data['notify_url'] = 'https://lottoyou.bet/paypal/feedback';
        $pagseguro_data['charset'] = 'utf-8';


        $pagseguro_data['lc'] = "en_US";
        $pagseguro_data['country_code'] = 'US';
        $pagseguro_data['currency_code'] = 'USD';
        $pagseguro_data['amount'] = $request['amount'];
        
        return $pagseguro_data;
    }
}