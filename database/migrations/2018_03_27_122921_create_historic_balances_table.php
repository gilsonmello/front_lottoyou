<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_balances', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();
            $length = 11;
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'user_id', compact('length', 'unsigned', 'nullable'));
            $table->addColumn('integer', 'balance_id', compact('length'));
            $table->decimal('from');
            $table->decimal('to');
            $table->string('others')->nullable()->comment="Caso veio de outro provedor, inserir aqui";
            $table->addColumn('integer', 'soccer_expert_id', compact('length'))->nullable();
            $table->addColumn('integer', 'scratch_card_id', compact('length'))->nullable();
            $table->addColumn('integer', 'lottery_id', compact('length'))->nullable();
            $table->addColumn('integer', 'order_id', compact('length'))->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_id')
                ->on('users')
                ->references('id');
            $table->foreign('soccer_expert_id')
                ->on('soc_categorias')
                ->references('id');
            $table->foreign('scratch_card_id')
                ->on('temas_raspadinhas')
                ->references('id');
            $table->foreign('lottery_id')
                ->on('lot_categorias')
                ->references('id');
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
        Schema::dropIfExists('historic_balances');
    }
}
