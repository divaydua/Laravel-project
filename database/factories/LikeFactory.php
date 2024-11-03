<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Like>
 */
class LikeFactory extends Factory
{
    protected $model = Like::class; // Add this line to specify the model

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Create a user for this like
            'post_id' => Post::factory(), // Create a post for this like
        ];
    }
}
