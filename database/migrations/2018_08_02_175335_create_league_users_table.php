<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeagueUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('league_users', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigInteger('id')->autoIncrement();
            $length = 11;
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'league_id', compact('length'))
                ->nullable();
            $table->addColumn('integer', 'owner_id', compact('length', 'unsigned', 'nullable'));
            $table->addColumn('integer', 'item_id', compact('length'))
                ->nullable();
            $table->addColumn('integer', 'historic_balance_id', compact('length'))
                ->nullable();
            $table->integer('positions');
            $table->integer('points');
            $table->timestamps();
            $table->foreign('league_id')
                ->on('leagues')
                ->references('id');
            $table->foreign('owner_id')
                ->on('users')
                ->references('id');
            $table->foreign('item_id')
                ->on('order_items')
                ->references('id');
            $table->foreign('historic_balance_id')
                ->on('historic_balances')
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
        Schema::dropIfExists('league_users');
    }
}
