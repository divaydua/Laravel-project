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
            'post_id' => Post::factory(), // Create a post for this comment
            'user_id' => User::factory(), // Create a user for this comment
            'content' => $this->faker->text(100),
        ];
    }
}
