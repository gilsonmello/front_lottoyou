<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContactProvider
 * @package App\Providers
 */
class BalanceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\API\Balance\BalanceContract',
            'App\Repositories\API\Balance\BalanceRepository'
        );
    }

}