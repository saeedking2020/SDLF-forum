<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = User::all()->pluck('id')->toArray();
        return [
            'title' => fake()->sentence,
            'desc' => fake()->paragraph,
            'image' => fake()->image,
            'user_id' => fake()->randomElement($user_ids),
        ];
    }
}
