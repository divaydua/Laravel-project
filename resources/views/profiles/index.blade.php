@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">My Profile</h1>
    
    <div class="bg-white shadow-md rounded-lg p-6">
        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Member Since:</strong> {{ $user->created_at->format('d M, Y') }}</p>
        <!-- Add more profile details here -->
    </div>
</div>
@endsection