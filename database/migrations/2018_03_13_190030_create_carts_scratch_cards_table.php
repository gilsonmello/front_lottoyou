<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsScratchCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_has_scratchcards', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cart_id')->unsigned();
            $table->integer('scratch_card_id')->unsigned()->nullable();
            $table->integer('quantity')->unsigned();
            $table->decimal('price');
            $table->decimal('discount_price');
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
        Schema::dropIfExists('carts_has_scratchcards');
    }
}
