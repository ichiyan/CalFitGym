<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_logs', function (Blueprint $table) {
            $table->id('logID');
            $table->dateTime('entry');
            $table->dateTime('exit');
            $table->foreignId('personID');
            $table->foreignId('loggerID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_logs');
    }
}
