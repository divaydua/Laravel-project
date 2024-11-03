<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class); // A comment belongs to a user
    }

    public function post()
    {
        return $this->belongsTo(Post::class); // A comment belongs to a post
    }
}
