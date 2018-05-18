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
            $balance = Balance::where('owner_id', '=', $item->owner)->get()->first();
            
            $historicBalance = new HistoricBalance;
            $historicBalance->owner_id = $balance->owner_id;
            $historicBalance->balance_id = $balance->id;
            $historicBalance->from = $balance->value;
            $historicBalance->scratch_card_id = $item->id;
            $historicBalance->to = $balance->value + $item->premio;
            $historicBalance->description = "scratchcard";
            $historicBalance->type = 1;
            $historicBalance->amount = $item->premio;
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