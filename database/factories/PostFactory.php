<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class; // Correctly reference the Post model

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Create a user for this post
            'content' => $this->faker->text(200),
        ];
    }
}
