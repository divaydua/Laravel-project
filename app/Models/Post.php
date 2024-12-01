<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'user_id'];

    protected $with = ['user', 'likes', 'comments.user'];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public function comments() 
    {
        return $this->hasMany(Comment::class); // A post can have many comments
    }

    public function likes()
    {
    return $this->hasMany(Like::class);
    }
}
