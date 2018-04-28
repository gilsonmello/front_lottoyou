<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\ScratchCard;
use App\Balance;
use App\HistoricBalance;

class ScratchCardObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(ScratchCard $item)
    {
        //
    }

    public function saved(ScratchCard $item)
    {
        if($item->premio > 0) {
            $balance = Balance::where('user_id', '=', $item->owner)->get()->first();
            
            $historicBalance = new HistoricBalance;
            $historicBalance->user_id = $balance->user_id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->to = $balance->value + $item->premio;
            $historicBalance->save();

            $balance->value += $item->premio;
            $balance->save();
        }
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(ScratchCard $item)
    {
        //
    }
}