<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Notification>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => User::inRandomOrder()->first()->id, // Random sender
            'receiver_id' => User::inRandomOrder()->first()->id, // Random receiver
            'type' => $this->faker->randomElement(['like', 'comment', 'follow']), // Random type
            'message' => $this->faker->sentence(), // Random message
            'is_read' => $this->faker->boolean(50), // 50% chance of being read
        ];
    }
    }
}
