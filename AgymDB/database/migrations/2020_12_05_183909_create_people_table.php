<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use  Illuminate\Database\QueryException ;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('fname', 30);
            $table->string('lname', 30);
            $table->date('birthday')->nullable();
            $table->string('street_address', 50)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('email_address', 50)->nullable();
            $table->integer('phone_number')->nullable();
            $table->string('emergency_contact_name', 50)->nullable();
            $table->integer('emergency_contact_number')->nullable();
            $table->string('emergency_contact_relationship', 50)->nullable();
            $table->string('photo', 50)->nullable();
            $table->foreignId('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
