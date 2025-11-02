<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Post;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => fake()->sentence(),
            // Picks a singular random user if already exists
            // If not then a new user is created using its factory and used
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            // Similar premise for the line above but for a Post instance
            'post_id' => Post::inRandomOrder()->first()?->id ?? Post::factory(),
        ];
    }
}
