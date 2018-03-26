<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
           
            $length = 11;

            $unsigned = true;

            $table->string('type')->nullable();

            $table->string('hash')->nullable();

            $table->addColumn('integer', 'cart_id', compact('length'));
            
            $table->json('data')->nullable();

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
        Schema::dropIfExists('cart_items');
    }
}
