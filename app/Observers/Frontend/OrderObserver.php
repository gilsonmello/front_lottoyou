<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\Order;
use App\HistoricBalance;
use App\Balance;

class OrderObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    public function saved(Order $order)
    {
        $balance = Balance::where('owner_id', '=', $order->user_id)->get()->first();
        $historicBalance = new HistoricBalance;
        $historicBalance->owner_id = $balance->owner_id;
        $historicBalance->from = $balance->value;
        $historicBalance->to = $balance->value - $order->sub_total;
        $historicBalance->balance_id = $balance->id;
        $historicBalance->order_id = $order->id;
        $historicBalance->save();
        $balance->value = $balance->value - $order->sub_total;
        $balance->save();
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(Order $order)
    {
        //
    }
}