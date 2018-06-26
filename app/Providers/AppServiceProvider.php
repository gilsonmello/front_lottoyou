<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Order;
use App\Cart;
use App\ScratchCard;
use App\OrderItem;
use App\Observers\OrderObserver;
use App\Observers\OrderItemObserver;
use App\Observers\ScratchCardObserver;
use App\Observers\CartObserver;
use App\Repositories\Frontend\User\UserRepository;
use App\Repositories\Frontend\User\UserEloquent;

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

    }
}
