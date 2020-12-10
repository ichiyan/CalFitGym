<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('batches', function (Blueprint $table) {
            $table->id('batchID');
            $table->integer('batchAmount');
            $table->integer('amtLeftBatch');
            $table->dateTime('expiryDate')->nullable();
            $table->dateTime('dateReceived');
            $table->foreignId('itemID');
            $table->foreignId('employeeID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('batches');
    }
}
