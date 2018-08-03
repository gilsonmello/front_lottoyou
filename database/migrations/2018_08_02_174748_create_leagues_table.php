<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaguesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leagues', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('slug');
            $table->boolean('open')->default(1);
            $table->boolean('active')->default(1);
            $table->decimal('value');
            $table->integer('quantity_users')->default(0);
            $table->string('bg_image')->nullable();
            $table->string('description')->nullable();
            $table->boolean('new')->default(1);
            $length = 11;
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'user_id', compact('length', 'unsigned', 'nullable'));
            $table->timestamps();
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
        Schema::dropIfExists('leagues');
    }
}
