<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('item_name', 100);
            $table->boolean('is_customizable');
            $table->boolean('has_variations');
            $table->boolean('has_different_prices');
            $table->integer('price')->nullable();
            $table->string('description', 200);
            $table->string('measurement', 200)->nullable();
            $table->string('weight', 200)->nullable();
            $table->string('item_pic', 100);
            $table->foreignId('category_id');
        });

        DB::table('items')->insert(
            array(
                ['item_name' => 'Whey Protein on the Go',
                'is_customizable' => 0,
                'has_variations' => 1,
                'has_different_prices' => 0,
                'price' => 70,
                'description' => 'Drink with Protein 25 grams & BCCAS 5.5 grams',
                'measurement' => null,
                'weight' => '330 mL',
                'item_pic' => 'wheyprotein.jpg',
                'category_id' => 2 ],

                ['item_name' => 'California Supplements Set',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 230, 
                'description' => 'includes 6 servings of combat whey protein, 6 capsule of Kirkland Fish Oil, 6 capsules of Abscuts, 6 GNC Creatine' ,
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'CaliforniaSupplementsSet.jpg',
                'category_id' => 1 ],

                ['item_name' => 'Whey',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 100,
                'description' => '3 packs of whey protein',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'whey.jpg',
                'category_id' => 1 ],

                ['item_name' => 'Gain Mass',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 100,
                'description' => '3 packs of Gain Mass',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'gainmass.jpg',
                'category_id' => 1 ],

                ['item_name' => 'C4 Pre-Workout',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 80,
                'description' => '2 packs of C4 Pre-Workout',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'c4PreWorkout.jpg',
                'category_id' => 1 ],

                ['item_name' => 'Peanut Butter with Whey Protein',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 50,
                'description' => 'double your protein needs with our peanut butter',
                'measurement' => null,
                'weight' => '50 mL',
                'item_pic' => 'peanutbutter.jpg',
                'category_id' => 1 ],

                ['item_name' => 'Complete Protein Milk Tea Series ',
                'is_customizable' => 0,
                'has_variations' => 1,
                'has_different_prices' => 1,
                'price' => null,
                'description' => 'Milk Tea + Protein + Chia seeds',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'proteinmilktea1.jpg',
                'category_id' => 2 ],

                ['item_name' => 'Women Gym Wear 3pcs Set',
                'is_customizable' => 0,
                'has_variations' => 1,
                'has_different_prices' => 1,
                'price' => null,
                'description' => 'made out of polyester & nylon to feel comfortable while doing workouts',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'WomenGymWearSet.png',
                'category_id' => 3 ],

                ['item_name' => 'Women Sport Sweatpants',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 300,
                'description' => 'made out of polyester fiber, 100% breathable and sleek ',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'WomenSportSweatpants.png',
                'category_id' => 3 ],

                ['item_name' => 'Men’s Tank Top Sleeveless',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 350,
                'description' => 'Gym Wear Terno for Men made out of Polyester; 100% breathable and comfortable to use for any workouts',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'MensTankTopSleeveless.png',
                'category_id' => 3 ],

                ['item_name' => 'Men’s Dri Fit Tshirt and Shorts Terno',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 350,
                'description' => 'Gym Wear Terno for Men made out of Polyester; 100% breathable and comfortable to use for any workouts',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'MensTshirtShortsTerno.png',
                'category_id' => 3 ],

                ['item_name' => 'Tumblr',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 239,
                'description' => 'eco-friendly, straw type with thermal insulation',
                'measurements' => '11.6 x 28.5cm',
                'weight' => '2L / 64oz',
                'item_pic' => 'tumblr.png',
                'category_id' => 5 ],

                ['item_name' => 'Mug',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 249,
                'description' => 'lead-free ceramic mug',
                'measurements' => '3.30"(8.5 cm) height x 3.75"(9.5 cm) diameter',
                'weight' => null,
                'item_pic' => 'mug.png',
                'category_id' => 5 ],

                ['item_name' => '10mm Yoga Mat',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 760,
                'description' => 'yoga mat with its matching bag',
                'measurements' => '183 cm x 61 cm',
                'weight' => null,
                'item_pic' => 'yogaMat.png',
                'category_id' => 4 ],

                ['item_name' => 'Gym Duffel Bag',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 579,
                'description' => 'soft nylon material and lining with interior and exterior zip pockets, zip closure, dual grab handles, and sling strap',
                'measurements' => 'length: 49  cm,  width: 18 cm, height: 27 cm',
                'weight' => null,
                'item_pic' => 'duffelBag.png',
                'category_id' => 4 ],

                ['item_name' => 'Nike Gym Sack',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 489,
                'description' => 'made out of 100% polyester with drawcord top closure for secure storage and shoulder straps for comfortable carrying',
                'measurements' => 'H 45.5cm x W 35.5cm',
                'weight' => null,
                'item_pic' => 'gymsack.png',
                'category_id' => 4 ],

                ['item_name' => 'MicroFiber Quick Dry Towel with Bag',
                'is_customizable' => 0,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 115,
                'description' => 'primarily made of microfiber',
                'measurements' => '60 * 30cm / 23.6 * 11.8in',
                'weight' => '2L / 64oz',
                'item_pic' => '41.5g / 1.45oz',
                'category_id' => 4 ],

                ['item_name' => 'Gym Armband Belt Case',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 299,
                'description' => 'Compatible Phone Sizes: Phones up to 6.1 inches (Phone size in maximum:150mm*72mm*8mm )',
                'measurement' => null,
                'weight' => null,
                'item_pic' => 'armband.png',
                'category_id' => 5 ],

                ['item_name' => 'Soft Folding Water Bottle',
                'is_customizable' => 1,
                'has_variations' => 0,
                'has_different_prices' => 0,
                'price' => 319,
                'description' => 'primarily made of TPU ',
                'measurements' => '26 * 7.5 * 3.5cm / 10.2 * 2.9 * 1.3in',
                'weight' => '500 mL',
                'item_pic' => 'foldingWaterBottle.png',
                'category_id' => 5 ],

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
        Schema::dropIfExists('items');
    }
}
