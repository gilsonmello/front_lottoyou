<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\Order;

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
        //
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