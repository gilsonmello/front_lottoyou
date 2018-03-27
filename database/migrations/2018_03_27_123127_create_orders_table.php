<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $length = 11;
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'user_id', compact('length', 'unsigned', 'nullable'));
            $table->decimal('total');
            $table->decimal('sub_total')->nullable();
            $table->integer('number_items')->nullable();
            $table->addColumn('integer', 'coupon_id', compact('length', 'nullable'));
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                ->on('users')
                ->references('id');
            $table->foreign('coupon_id')
                ->on('coupons')
                ->references('id');
        });

        Schema::create('orders_has_lotteries', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'order_id', compact('length'));
            $table->addColumn('integer', 'lottery_id', compact('length'));
            $table->longText('data')->nullable();
            $table->foreign('order_id')
                ->on('orders')
                ->references('id');
            $table->foreign('lottery_id')
                ->on('lot_categorias')
                ->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders_has_lotteries');
        Schema::dropIfExists('orders');
    }
}
