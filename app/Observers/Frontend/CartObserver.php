<?php

namespace App\Observers\Frontend;

use App\Model\Frontend\Cart;

class CartObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(Cart $order)
    {
        //
    }

    public function saved(Cart $order)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleting(Cart $order)
    {
        //
    }
}