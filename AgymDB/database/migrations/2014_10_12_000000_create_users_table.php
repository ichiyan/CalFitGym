<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

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
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                ['name' => 'Gabriela',
                'email' => "admin@gmail.com",
                'password' => bcrypt('p@ssw0rd'),
                ],

                ['name' => 'Bona',
                'email' => "bona@admin.com",
                'password' => bcrypt('adminadmin'),
                ],

                ['name' => 'Anne',
                'email' => "anne@gmail.com",
                'password' => bcrypt('adminpass'),
               ]
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
        Schema::dropIfExists('users');
    }
}
