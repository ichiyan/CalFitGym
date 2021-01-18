<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'fname'=> $this->faker->firstName,
            'lname'=> $this->faker->lastName,
            'birthday'=> $this->faker->date,
            'street_address'=> $this->faker->streetAddress,
            'barangay'=> $this->faker->streetName,
            'city'=> $this->faker->city,
            'email_address'=> $this->faker->unique()->safeEmail,
            'phone_number'=> $this->faker->phoneNumber,
            'emergency_contact_name'=> $this->faker->name,
            'emergency_contact_number'=> $this->faker->phoneNumber,
            'emergency_contact_relationship'=> $this->faker->jobTitle,
            'photo'=> $this->faker->imageUrl,
        ];
    }
}
