<?php

namespace Database\Factories;

use App\Models\Forum;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user_ids = User::all()->pluck('id')->toArray();
        $forum_ids = Forum::all()->pluck('id')->toArray();
        return [
            'title' => fake()->sentence,
            'desc' => fake()->paragraph,
            'forum_id' => fake()->randomElement($forum_ids),
            'user_id' => fake()->randomElement($user_ids),
        ];
    }
}
