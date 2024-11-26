<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Profile;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::factory()
        ->count(10) // Create 10 users
        ->hasProfile() // Each user has 1 profile
        ->has(
            Post::factory()
                ->count(3) // Each user has 3 posts
                ->has(Comment::factory()->count(2)) // Each post has 2 comments
                ->has(Like::factory()->count(1)) // Each post has 1 like
        )
        ->create();
    }
}
