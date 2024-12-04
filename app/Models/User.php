<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',       // Allow mass assignment of the name field
        'email',      // Allow mass assignment of the email field
        'password',   // Allow mass assignment of the password field
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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
    public function notifications()
{
    return $this->hasMany(Notification::class, 'receiver_id');
}
}