<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'body' => fake()->paragraph(5),
            // Takes first user_id from users table randomly if it exists otherwise
            // it will create a new user using the UserFactory
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
        ];
    }
}
