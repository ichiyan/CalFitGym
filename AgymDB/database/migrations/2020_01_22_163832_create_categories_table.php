<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('category', 50);
        });

        DB::table('categories')->insert(
            array(
                ['category' => 'Nutrition'],
                ['category' => 'Beverages'],
                ['category' => 'Active Wear'],
                ['category' => 'Gym Essentials'],
                ['category' => 'Merchandise'],
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
        Schema::dropIfExists('categories');
    }
}
