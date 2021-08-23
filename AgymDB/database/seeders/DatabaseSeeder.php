<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Person;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();
        //$this->call(UserSeeder::class);
        $this->call(LaratrustSeeder::class);
        $admins = User::get();
        foreach ($admins as $admin){
            $admin->attachRole('admin');
            $person = new Person(['fname'=>$admin->name, 'lname'=> ' ',
                                'birthday'=> '2000-08-08', 'street_address'=> ' ',
                                'barangay'=> ' ','city'=> ' ',
                                'email_address'=>$admin->email,
                                'phone_number'=> ' ', 'emergency_contact_name'=> ' ',
                                'emergency_contact_number'=> ' ', 'emergency_contact_relationship'=> ' ',
                                'photo'=> 'default-profile.png', 'user_id'=> $admin->id ]);
            $person->save();
        }
    }
}
