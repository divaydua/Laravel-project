<?php

namespace Database\Factories;
use App\Models\User;
use App\Models\Post;
use App\Models\Profile;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => User::factory(), // Associate with a user
            'bio' => $this->faker->sentence(), // Generate a fake bio
            'profile_picture' => $this->faker->imageUrl(), // Generate a fake profile picture URL
        ];
    }
}
