<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'user_id' => User::factory(),
            'city' => $this->faker->city(),
            'age' => rand(18, 80),
            'gender' => rand(1, 2) === 1 ? 'male' : 'female',
        ];
    }
}
