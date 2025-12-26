<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    protected $model = Address::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'division' => $this->faker->word,
            'district' => $this->faker->word,
            'upazila' => $this->faker->word,
            'locality' => $this->faker->word,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->postcode,
            'country' => 'Bangladesh',
            'landmark' => $this->faker->word,
            'type' => $this->faker->randomElement(['home', 'office', 'other']),
            'is_default' => $this->faker->boolean,
            'user_id' => User::inRandomOrder()->first()->id, // র্যান্ডম ইউজার আইডি
        ];
    }
}
