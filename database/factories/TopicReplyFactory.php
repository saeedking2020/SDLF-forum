<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TopicReply>
 */
class TopicReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topic_ids = Topic::all()->pluck('id')->toArray();
        $user_ids = User::all()->pluck('id')->toArray();
        return [
            'desc' => fake()->paragraph,
            'topic_id' => fake()->randomElement($topic_ids),
            'user_id' => fake()->randomElement($user_ids),
        ];
    }
}
