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
        // Find the user by ID
        $user = User::findOrFail($id);

        // Return the view with user details
        return view('users.show', compact('user'));
    }
}