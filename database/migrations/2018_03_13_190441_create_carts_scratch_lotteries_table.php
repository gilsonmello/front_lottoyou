<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsScratchLotteriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_scratch_has_lotteries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->integer('lottery_id')->unsigned();
            $table->integer('quantity')->unsigned();
            $table->decimal('price');
            $table->decimal('discount_price');
            $table->string('numbers');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('cart_id')
                ->on('carts')
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
        Schema::dropIfExists('carts_scratch_has_lotteries');
    }
}
