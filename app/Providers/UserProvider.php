<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContactProvider
 * @package App\Providers
 */
class UserProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\API\User\UserContract',
            'App\Repositories\API\User\UserRepository'
        );
    }

}