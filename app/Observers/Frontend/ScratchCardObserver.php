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