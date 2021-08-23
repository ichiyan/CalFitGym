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
            $table->string('barangay', 50)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('email_address', 50)->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->string('emergency_contact_name', 50)->nullable();
            $table->string('emergency_contact_number', 20)->nullable();
            $table->string('emergency_contact_relationship', 50)->nullable();
            $table->string('photo', 200)->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users', 'id');
            // $table->integer('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users');
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
