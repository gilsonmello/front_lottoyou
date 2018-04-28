<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;
use App\User;
use App\Model\Frontend\Order;
use App\Model\Frontend\Cart;
use App\Model\Frontend\ScratchCard;
use App\Model\Frontend\OrderItem;
use App\Observers\UserObserver;
use App\Observers\Frontend\OrderObserver;
use App\Observers\Frontend\OrderItemObserver;
use App\Observers\Frontend\ScratchCardObserver;
use App\Observers\Frontend\CartObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //User::observe(UserObserver::class);
        Order::observe(OrderObserver::class);
        OrderItem::observe(OrderItemObserver::class);
        ScratchCard::observe(ScratchCardObserver::class);
        Cart::observe(CartObserver::class);
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
