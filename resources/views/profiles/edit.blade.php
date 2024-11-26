@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <h1>Edit Profile</h1>

    <form action="{{ route('profiles.update', $profile->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="bio">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="4">{{ $profile->bio }}</textarea>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection