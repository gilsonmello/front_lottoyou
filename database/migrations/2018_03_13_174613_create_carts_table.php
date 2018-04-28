<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->integer('id')->autoIncrement();

            $length = 11;

            $unsigned = true;

            $nullable = true;

            $table->addColumn('integer', 'user_id', compact('length', 'unsigned', 'nullable'));

            $table->boolean('finished')->default(0);
            
            $table->ipAddress('visitor');

            $table->timestamps();
            
            $table->softDeletes();
            
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
        Schema::dropIfExists('carts');
    }
}
