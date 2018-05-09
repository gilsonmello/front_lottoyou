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
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();
           
            $length = 11;

            $unsigned = true;

            $table->string('type')->nullable();

            $table->string('hash')->nullable();

            $table->addColumn('integer', 'order_id', compact('length'))
                ->nullable();

            $table->addColumn('integer', 'soccer_expert_id', compact('length'))
                ->nullable();
                
            $table->addColumn('integer', 'lottery_id', compact('length'))
                ->nullable();

            $table->addColumn('integer', 'scratch_card_id', compact('length'))
                ->nullable();
            
            $table->longText('data')->nullable();

            $table->timestamps();
            
            $table->softDeletes();

            $table->foreign('order_id')
                ->on('orders')
                ->references('id');
            $table->foreign('soccer_expert_id')
                ->on('soc_categorias')
                ->references('id');
            $table->foreign('lottery_id')
                ->on('lot_categorias')
                ->references('id');
            $table->foreign('scratch_card_id')
                ->on('temas_raspadinhas')
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
