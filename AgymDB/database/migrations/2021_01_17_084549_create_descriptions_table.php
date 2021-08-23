<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('description', 500);
            $table->foreignId('member_type_id')->constrained('member_types', 'id');
        });

        DB::table('descriptions')->insert(
            array(
                ['description' => 'Free WIFI', 
                'member_type_id' => 1],
                ['description' => 'Shower Room Access', 
                'member_type_id' => 1],
                ['description' => 'Free Locker', 
                'member_type_id' => 1],
                ['description' => 'Access to all Gym Facilities', 
                'member_type_id' => 1],
                ['description' => 'Expires in 24 hours', 
                'member_type_id' => 1],

                ['description' => 'Gain Special Acess to the California Fitness Gym Website', 
                'member_type_id' => 2],
                ['description' => 'Free WIFI', 
                'member_type_id' => 2],
                ['description' => 'Shower Room Access', 
                'member_type_id' => 2],
                ['description' => 'Free Locker', 
                'member_type_id' => 2],
                ['description' => 'Access to all Gym Facilities', 
                'member_type_id' => 2],
                ['description' => 'Expires in 30 days', 
                'member_type_id' => 2],

                ['description' => 'Personalized Coaching: One-on-One Coaching with a Professional Trainer', 
                'member_type_id' => 3],
                ['description' => 'Gain Special Acess to the California Fitness Gym Website', 
                'member_type_id' => 3],
                ['description' => 'Free WIFI', 
                'member_type_id' => 3],
                ['description' => 'Shower Room Access', 
                'member_type_id' => 3],
                ['description' => 'Free Locker', 
                'member_type_id' => 3],
                ['description' => 'Access to all Gym Facilities', 
                'member_type_id' => 3],
                ['description' => 'Expires in 30 days', 
                'member_type_id' => 3]
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
        Schema::dropIfExists('descriptions');
    }
}
