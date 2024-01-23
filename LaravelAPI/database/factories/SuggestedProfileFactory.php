<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\SuggestedProfile;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SuggestedProfile>
 */


 
class SuggestedProfileFactory extends Factory

{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = SuggestedProfile::class;

    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'approval' => $this->faker->boolean(35),
            'user_id' => User::factory(),
        ];
    }
}
