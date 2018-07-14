<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class ContactProvider
 * @package App\Providers
 */
class ContactProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\API\Contact\ContactContract',
            'App\Repositories\API\Contact\ContactRepository'
        );
    }

}