<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class CartProvider
 * @package App\Providers
 */
class CartProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\API\Cart\CartContract',
            'App\Repositories\API\Cart\CartRepository'
        );
    }

}