<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'users';

    /**
     * Relationship: A user has many posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class); // A user can have many posts
    }

    /**
     * Relationship: A user has many comments
     */
    public function comments()
    {
        return $this->hasMany(Comment::class); // A user can have many comments
    }

    /**
     * Relationship: A user can have many likes
     */
    public function likes()
    {
        return $this->hasMany(Like::class); // A user can like many posts
    }

    /**
     * Relationship: A user has one profile
     */
    public function profile()
    {
        return $this->hasOne(Profile::class); // A user has one profile
    }
}