<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('name');
            $table->string('code');
            $table->decimal('percentage')->nullable();
            $table->decimal('value')->nullable();
            $table->dateTime('date_begin');
            $table->dateTime('date_end')->nullable();
            $table->integer('quantity_use')->nullable();
            $table->integer('used')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('coupons_has_lotteries', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'coupon_id', compact('length'));
            $table->addColumn('integer', 'lottery_id', compact('length'));
            $table->foreign('coupon_id')
                ->on('coupons')
                ->references('id');
            $table->foreign('lottery_id')
                ->on('lot_categorias')
                ->references('id');
        });

        Schema::create('coupons_has_soccer_experts', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'coupon_id', compact('length'));
            $table->addColumn('integer', 'soccer_expert_id', compact('length'));
            $table->foreign('coupon_id')
                ->on('coupons')
                ->references('id');
            $table->foreign('soccer_expert_id')
                ->on('soc_categorias')
                ->references('id');
        });

        Schema::create('coupons_has_scratch_cards', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $unsigned = true;
            $nullable = true;
            $table->addColumn('integer', 'coupon_id', compact('length'));
            $table->addColumn('integer', 'scratch_card_id', compact('length'));
            $table->foreign('coupon_id')
                ->on('coupons')
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
        Schema::dropIfExists('coupons_has_scratch_cards');
        Schema::dropIfExists('coupons_has_soccer_experts');
        Schema::dropIfExists('coupons_has_lotteries');
        Schema::dropIfExists('coupons');
    }
}
