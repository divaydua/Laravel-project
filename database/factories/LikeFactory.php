<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Post;
use App\Models\Like;
use Illuminate\Database\Eloquent\Factories\Factory;

class LikeFactory extends Factory
{
    protected $model = Like::class; 

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Creates a user for this like
            'post_id' => Post::factory(), // Creates a post for this like
        ];
    }
}
