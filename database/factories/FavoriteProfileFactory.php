<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RealEstate;
use App\Models\User;
use App\Models\FavoriteProfile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FavoriteProfile>
 */
class FavoriteProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = FavoriteProfile::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'realestate_id' => RealEstate::factory(),
        ];
    }
}
