<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('variations', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('price')->nullable();
            $table->string('description', 500)->nullable();
            $table->foreignId('item_id');
            $table->foreignId('variation_category_id');
        });

        DB::table('variations')->insert(
            array(
                ['name' => 'Vanilla',
                'price' => 70,
                'description' => null,
                'item_id' => 1,
                'variation_category_id' => 2],

                ['name' => 'Chocolate',
                'price' => 70,
                'description' => null,
                'item_id' => 1,
                'variation_category_id' => 2],

                ['name' => 'Original',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Wintermelon',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Taru Ube ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Okinawa ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Matcha ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Hokkaido ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Salted Caramel ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Chocolate ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Thai ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Toffee Caramel ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => 'Red Velvet ',
                'price' => null ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 2],

                ['name' => '16oz',
                'price' => 85,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 1],

                ['name' => '22oz',
                'price' => 95 ,
                'description' => null,
                'item_id' => 7,
                'variation_category_id' => 1],

                ['name' => 'Small',
                'price' => 600 ,
                'description' => 'Shirt: bust:48x2 cm top length:45cm; Short: waist:33x2 cm shorts length:29cm; Bra: 32A/70A 32B/70B 32C/70C 34A/75A',
                'item_id' => 8,
                'variation_category_id' => 1],

                ['name' => 'Medium',
                'price' => 620 ,
                'description' => 'Shirt: bust:49x2 cm top length:47cm; Short: waist:35x2 cm shorts length:30cm; Bra: 34B/75B 34C/75C 36A/80A 36B/80B',
                'item_id' => 8,
                'variation_category_id' => 1],

                ['name' => 'Large',
                'price' => 650 ,
                'description' => 'Shirt: bust:50x2 cm top length:48cm; Short: waist:37x2 cm shorts length:31cm; Bra: 36C/80C 38A/85A 38B/85B 38C/85C',
                'item_id' => 8,
                'variation_category_id' => 1],

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
        Schema::dropIfExists('variations');
    }
}
