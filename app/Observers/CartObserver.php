<?php

namespace App\Observers;

use App\Cart;

class CartObserver
{
    /**
     * Listen to the User created event.
     *
     * @param Cart $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        //
    }

    /**
     * @param Cart $cart
     */
    public function saved(Cart $cart)
    {
        //
    }

    /**
     * Listen to the User deleting event.
     *
     * @param Cart $cart
     * @return void
     */
    public function deleting(Cart $cart)
    {
        //
    }
}