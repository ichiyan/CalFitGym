<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->date('birthday');
            $table->string('streetAddress', 50);
            $table->string('city', 20);
            $table->string('emailAddress', 50);
            $table->integer('phoneNumber');
            $table->string('username', 50);
            $table->string('password', 50);
            $table->enum('userType', ['admin', 'employee', 'customer']);
            $table->string('photo', 50);
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
