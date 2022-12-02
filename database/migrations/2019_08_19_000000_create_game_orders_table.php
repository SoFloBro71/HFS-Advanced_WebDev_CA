<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->decimal('shipping_cost');
            $table->decimal('order_cost');
            $table->foreignId('game_id');
            $table->timestamp('payed_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_order');
    }
};
