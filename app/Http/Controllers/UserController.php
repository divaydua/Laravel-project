<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Display a listing of users
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();
        
        // Return the view with the list of users
        return view('users.index', compact('users'));
    }

    // Display a single user
    public function show($id)
    {
        $user = User::with(['posts.comments', 'posts.likes'])->findOrFail($id);

        return view('users.show', compact('user'));
    }
    
    public function notifications()
{
    return $this->hasMany(Notification::class, 'receiver_id');
}
}