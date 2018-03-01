<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaspadinhaCapaPremiacoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('raspadinha_capa_premiacoes', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('img')->nullable();
            $length = 11;
            $unsigned = true;
            $table->addColumn('integer', 'temas_raspadinhas_id', compact('length'));
            //$table->addColumn('integer', 'temas_raspadinhas_id', ['unsigned' => true, 'length' => 11]);
            //$table->integer('temas_raspadinhas_id', false, true);
            $table->timestamps();
            $table->softDeletes();
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
