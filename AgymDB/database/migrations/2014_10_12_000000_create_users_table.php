<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('user_type', ['admin', 'employee', 'customer']);
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                ['name' => 'Gabriela',
                'email' => "admin@gmail.com",
                'password' => bcrypt('p@ssw0rd'),
                'user_type' => 'admin'],

                ['name' => 'Bona',
                'email' => "bona@admin.com",
                'password' => bcrypt('adminadmin'),
                'user_type' => 'admin'],
                
                ['name' => 'Anne',
                'email' => "anne@gmail.com",
                'password' => bcrypt('adminpass'),
                'user_type' => 'admin']
            )
        );

        // DB::table('users')->insert(
        //     array(
        //         'name' => 'Gabriela',
        //         'email' => "admin@gmail.com",
        //         'password' => bcrypt('p@ssw0rd'),
        //         'user_type' => 'admin'
        //     )
        // );

        // DB::table('users')->insert(
        //     array(
        //         'name' => 'Anne',
        //         'email' => "anne@gmail.com",
        //         'password' => bcrypt('adminpass'),
        //         'user_type' => 'admin'
        //     )
        // );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
