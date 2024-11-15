<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class; 

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a user for this post
            'content' => $this->faker->text(200),
        ];
    }
}
