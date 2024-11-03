<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class); // A post belongs to a user
    }

    public function comment()
    {
        return $this->hasMany(Comment::class); // A post can have many comments
    }

    public function like()
    {
        return $this->hasMany(Like::class); // A post can be liked by many users
    }
}
