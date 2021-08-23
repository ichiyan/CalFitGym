<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\EntryLog;

use Carbon\Carbon;

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

            $person_id = DB::table('people')->orderBy("id", "desc")->first()->id;

            $employee = new Employee(['id'=>$person_id, 'date_hired'=>'2021-08-08',
                                    'date_separated'=>NULL, 'monthly_salary'=>'40000',
                                    'no_of_trainees'=>0, 'person_id'=>$person_id ]);

            $employee->save();

            $user_id = 1;
            $now = Carbon::now();

            $logger = DB::table('people')->where('user_id', $user_id)->first();
            $init_log = new EntryLog(['entry'=>$now, 'exit'=>$now, 'person_id'=>$person_id, 'logger_id'=>$logger->id]);
            $init_log->save();

        }
    }
}
