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
            $table->id('basketID');
            $table->integer('quantity');
            $table->foreignId('orderID');
            $table->foreignId('itemID')->nullable();
            $table->foreignId('batchID')->nullable();
            $table->foreignId('customizeID')->nullable();
            $table->foreignId('membershipID')->nullable();
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
