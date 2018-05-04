<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartSoccerExpertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_soccer_experts', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();
           
            $length = 11;

            $unsigned = true;

            $table->addColumn('integer', 'cart_id', compact('length'));
            
            $table->longText('data')->nullable();

            $table->string('hash')->nullable();

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
        Schema::dropIfExists('cart_soccer_experts');
    }
}
