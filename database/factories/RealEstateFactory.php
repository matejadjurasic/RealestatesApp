<?php

namespace Database\Factories;

use App\Models\RealEstate;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RealEstate>
 */
class RealEstateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */



    public function definition()
    {
            return [
                'username' => $this->faker->userName,
                'profile_picture_url' => $this->faker->imageUrl(),
                'description' => $this->faker->text,
                'follows_count' => $this->faker->numberBetween(100, 500),
                'location' => $this->faker->city,
                'followers_count' => $this->faker->numberBetween(500, 100000),
                'price' => $this->faker->randomFloat(2, 1000, 100000),
            ];
    }
}
