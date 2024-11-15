<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    
    use HasFactory;

    // Explicitly define the table name
    protected $table = 'users';


    public function posts()
    {
        return $this->hasMany(Post::class); // A user can have many posts
    }

    public function comments()
    {
        return $this->hasMany(Comment::class); // A user can have many comments
    }

    public function likes()
    {
        return $this->hasMany(Like::class); // A user can like many posts
    }

    public function profile()
    {
        return $this->hasOne(Profile::class); // A user has one profile
    }
}
