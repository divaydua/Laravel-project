<?php

namespace App\Http\Controllers;
use App\Models\Profile; // Import the Profile model
use App\Models\User;    // Import the User model
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Display a listing of profiles
    public function index()
    {
        $profiles = Profile::with('user')->paginate(10); // Fetch profiles with pagination
        return view('profiles.index', compact('profiles'));
    }

    // Show the form for creating a new profile
    public function create()
    {
        $users = User::doesntHave('profile')->pluck('name', 'id'); // Fetch users without profiles
        return view('profiles.create', compact('users'));
    }

    // Store a newly created profile in the database
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id|unique:profiles,user_id', // Ensure user ID is unique in profiles
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048', // Optional profile picture
        ]);

        $data = $request->only(['user_id', 'bio']);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        Profile::create($data);

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    // Show a specific profile
    public function show($id)
    {
        $profile = Profile::with('user')->findOrFail($id); // Fetch the profile with user data
        return view('profiles.show', compact('profile'));
    }

    // Show the form for editing a profile
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('profiles.edit', compact('profile'));
    }

    // Update the specified profile in the database
    public function update(Request $request, $id)
    {
        $profile = Profile::findOrFail($id);

        $request->validate([
            'bio' => 'nullable|string',
            'profile_picture' => 'nullable|image|max:2048', // Optional profile picture
        ]);

        $data = $request->only(['bio']);

        // Handle profile picture upload
        if ($request->hasFile('profile_picture')) {
            $data['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $profile->update($data);

        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    // Delete the specified profile
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
