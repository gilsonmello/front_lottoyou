<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use App\Order;
use App\Cart;
use App\ScratchCard;
use App\OrderItem;
use App\Observers\OrderObserver;
use App\Observers\OrderItemObserver;
use App\Observers\ScratchCardObserver;
use App\Observers\CartObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //URL::forceScheme('https');
        //User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        ScratchCard::observe(ScratchCardObserver::class);
        Cart::observe(CartObserver::class);
        Schema::defaultStringLength(191);
        if(config('app.url_locale') == 'en_US/') {
            config(['app.url_locale' => '']);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
