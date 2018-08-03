<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueAwardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_awards', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();
            $length = 11;
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'league_id', compact('length'))
                ->nullable();
            $table->addColumn('integer', 'user_id', compact('length', 'unsigned', 'nullable'));
            $table->integer('position');
            $table->decimal('value');
            $table->timestamps();
            $table->foreign('league_id')
                ->on('leagues')
                ->references('id');
            $table->foreign('user_id')
                ->on('users')
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
        Schema::dropIfExists('league_awards');
    }
}
