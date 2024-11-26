@extends('layouts.app')

@section('title', 'Profiles')

@section('content')
    <h1>Profiles</h1>
    <a href="{{ route('profiles.create') }}" class="btn btn-primary">Create Profile</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Bio</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($profiles as $profile)
                <tr>
                    <td>{{ $profile->id }}</td>
                    <td>{{ $profile->user->name }}</td>
                    <td>{{ $profile->bio }}</td>
                    <td>
                        <a href="{{ route('profiles.show', $profile->id) }}">View</a>
                        <a href="{{ route('profiles.edit', $profile->id) }}">Edit</a>
                        <form action="{{ route('profiles.destroy', $profile->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $profiles->links() }}
@endsection