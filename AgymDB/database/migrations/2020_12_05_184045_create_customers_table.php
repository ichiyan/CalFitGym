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
            $table->foreignId('member_type_id')->default(0);
            $table->foreignId('assigned_employee_id')->default(NULL)->nullable();
            $table->foreignId('person_id');
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
