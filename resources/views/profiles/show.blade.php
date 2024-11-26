@extends('layouts.app')

@section('title', 'Profile Details')

@section('content')
    <h1>Profile Details</h1>
    <p><strong>User:</strong> {{ $profile->user->name }}</p>
    <p><strong>Bio:</strong> {{ $profile->bio }}</p>

    @if ($profile->profile_picture)
        <img src="{{ asset('storage/' . $profile->profile_picture) }}" alt="Profile Picture" style="width: 150px;">
    @endif
@endsection