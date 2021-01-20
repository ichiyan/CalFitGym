<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_types', function (Blueprint $table) {
            $table->id();
            $table->string('member_type_name', 20);
            $table->integer('member_type_price');
            $table->integer('length');
            $table->boolean('has_trainer')->default(0);
        });

        DB::table('member_types')->insert(
            array(
                'member_type_name' => 'Walk-In', 
                'member_type_price'  => 150,
                'length'  => 1,
                'has_trainer' => 0
            )
        );

        DB::table('member_types')->insert(
            array(
                'member_type_name' => 'Monthly-In', 
                'member_type_price'  => 1000,
                'length'  => 30,
                'has_trainer' => 0
            )
        );

        DB::table('member_types')->insert(
            array(
                'member_type_name' => 'Premium', 
                'member_type_price'  => 3000,
                'length'  => 30,
                'has_trainer' => 1
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_types');
    }
}
