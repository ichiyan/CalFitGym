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
            $table->id();
            $table->timestamps();
            $table->integer('height')->nullable();
            $table->integer('weight')->nullable();
            $table->string('pre_existing_conditions', 200)->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->default(NULL)->nullable();
            $table->foreignId('member_type_id')->default(0);
            // $table->integer('member_type_id')->unsigned();
            // $table->foreign('member_type_id')->references('id')->on('member_types');
            $table->foreignId('assigned_employee_id')->default(NULL)->nullable();
            // $table->integer('assigned_employee_id')->unsigned();
            // $table->foreign('assigned_employee_id')->references('id')->on('employees');
            $table->foreignId('person_id');
            // $table->integer('person_id')->unsigned();
            // $table->foreign('person_id')->references('id')->on('people');
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
