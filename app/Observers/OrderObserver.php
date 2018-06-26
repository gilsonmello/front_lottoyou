<?php

namespace App\Observers;

use App\Order;
use App\HistoricBalance;
use App\Balance;

class OrderObserver
{
    /**
     * Listen to the User created event.
     *
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * @param Order $order
     */
    public function saved(Order $order)
    {
        /*$balance = Balance::where('owner_id', '=', $order->user_id)->get()->first();
        $historicBalance = new HistoricBalance;
        $historicBalance->owner_id = $balance->owner_id;
        $historicBalance->from = $balance->value;
        $historicBalance->to = $balance->value - $order->sub_total;
        $historicBalance->balance_id = $balance->id;
        $historicBalance->order_id = $order->id;
        $historicBalance->description = "order";
        $historicBalance->type = 0;
        $historicBalance->amount = $order->sub_total * -1;
        $historicBalance->save();
        $balance->value = $balance->value - $order->sub_total;
        $balance->save();*/
    }

    /**
     * Listen to the User deleting event.
     *
     * @param Order $order
     * @return void
     */
    public function deleting(Order $order)
    {
        //
    }
}