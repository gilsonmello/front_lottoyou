<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaspadinhaDemonstracoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raspadinha_demonstracoes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $length = 11;
            $unsigned = true;
            $table->addColumn('integer', 'lote_id', compact('length'));
            $table->addColumn('integer', 'user_id', compact('length', 'unsigned'));
            $table->addColumn('integer', 'temas_raspadinha_id', compact('length'));
            $table->float('valor1');
            $table->float('valor2');
            $table->float('valor3');
            $table->float('valor4');
            $table->float('valor5');
            $table->float('valor6');
            $table->float('valor7');
            $table->float('valor8');
            $table->float('valor9');
            $table->float('valor10')->nullable();
            $table->float('premio')->nullable()->comment = 'coluna criada para ser o valor do premio para relatorio';
            $table->integer('ativo');
            $table->dateTime('created')->nullable();
            $table->dateTime('modified')->nullable();
            $table->dateTime('data_validade_inicial')->nullable();
            $table->dateTime('data_validade_final')->nullable();
  
            //$table->addColumn('integer', 'temas_raspadinhas_id', ['unsigned' => true, 'length' => 11]);
            //$table->integer('temas_raspadinhas_id', false, true);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('lote_id')
                ->on('ras_lotes')
                ->references('id');
            $table->foreign('user_id')
                ->on('users')
                ->references('id');
            $table->foreign('temas_raspadinhas_id')
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
        Schema::dropIfExists('raspadinha_capa_premiacoes');
    }
}
