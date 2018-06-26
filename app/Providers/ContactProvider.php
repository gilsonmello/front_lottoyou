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
            'App\Repositories\Frontend\Contact\ContactContract',
            'App\Repositories\Frontend\Contact\ContactRepository'
        );
    }

}