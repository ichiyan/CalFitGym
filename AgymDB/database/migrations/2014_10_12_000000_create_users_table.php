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
            $table->enum('user_type', ['admin', 'employee', 'customer']);
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

        // $admin1 = User::create([
        //     'name' => 'Bona',
        //     'email' => "bona@admin.com",
        //     'password' => bcrypt('adminadmin'),
        // ]);

        // $admin2 = User::create([
        //     'name' => 'Gabriela',
        //     'email' => "admin@gmail.com",
        //     'password' => bcrypt('p@ssw0rd'),
        // ]);

        // $admin3 = User::create([
        //     'name' => 'Anne',
        //     'email' => "anne@gmail.com",
        //     'password' => bcrypt('adminpass'),
        // ]);

        // $admin1->attachRole('admin');
        // $admin2->attachRole('admin');
        // $admin3->attachRole('admin');
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
