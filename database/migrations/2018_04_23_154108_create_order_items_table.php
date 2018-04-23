<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
           
            $length = 11;

            $unsigned = true;

            $table->string('type')->nullable();

            $table->string('hash')->nullable();

            $table->addColumn('integer', 'order_id', compact('length', 'unsigned'));
            
            $table->longText('data')->nullable();

            $table->timestamps();
            
            $table->softDeletes();

            $table->foreign('order_id')
                ->on('orders')
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
        Schema::dropIfExists('order_items');
    }
}
