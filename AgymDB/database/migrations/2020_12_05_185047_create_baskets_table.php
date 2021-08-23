<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('order_id')->constrained('orders', 'id');
            $table->foreignId('item_id')->nullable()->constrained('items', 'id');
            $table->foreignId('batch_id')->nullable()->constrained('batches', 'id');
            $table->foreignId('customize_id')->nullable()->constrained('customizes', 'id');
            $table->foreignId('membership_id')->nullable()->constrained('memberships', 'id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('baskets');
    }
}
