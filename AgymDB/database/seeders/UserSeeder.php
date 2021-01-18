<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = factory(User::class, 15)->create()->each(function($user){
            $user->personInfo()->save(factory(Person::class)->make());
        });

        // DB::table('users')->insert([

        //     'name'=>str_random(10),
        //     'email'=>str_random(10).'@gmail.com',
        //     'password'=>bcrypt('secret'),
        //     'user_type'=>'customer'
        // ]);
    }
}
