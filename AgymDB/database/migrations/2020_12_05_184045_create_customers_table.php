<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('customerID');
            $table->timestamps();
            $table->string('emergencyContactName', 50);
            $table->integer('emergencyContactNumber');
            $table->integer('height');
            $table->integer('weight');
            $table->string('preExistingConditions', 200);
            $table->foreignId('memberTypeID');
            $table->foreignId('assignedEmployeeID');
            $table->foreignId('personID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
