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
            $table->id('personID');
            $table->timestamps();
            $table->string('fname', 30);
            $table->string('lname', 30);
            $table->date('birthday')->nullable();
            $table->string('streetAddress', 50)->nullable();
            $table->string('city', 20)->nullable();
            $table->string('emailAddress', 50)->nullable();
            $table->integer('phoneNumber')->nullable();
            $table->string('username', 50);
            $table->string('password', 50);
            $table->enum('userType', ['admin', 'employee', 'customer']);
            $table->string('photo', 50)->nullable();
            $table->foreignId('userID');
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
