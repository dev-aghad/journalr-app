<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bio' => fake()->sentence(),
            'profile_picture' => fake()->randomElement([
                'avatar1.png', 'avatar2.png', 'avatar3.png', 'avatar4.png']),
            'user_id' => User::factory(),
        ];
    }
}
