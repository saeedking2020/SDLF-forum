<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Forum>
 */
class ForumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $category_ids = Category::all()->pluck('id')->toArray();

        return [
            'title' => fake()->sentence,
            'desc' => fake()->paragraph,
            'user_id' => fake()->randomElement($user_ids),
            'category_id' => fake()->randomElement($category_ids),
        ];
    }
}
