@extends('layouts.app')

@section('title', 'User Details')

@section('content')
    <h2>User Details</h2>
    <p><strong>ID:</strong> {{ $user->id }}</p>
    <p><strong>Name:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Created At:</strong> {{ $user->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $user->updated_at }}</p>
    <a href="{{ route('users.index') }}">Back to Users</a>
@endsection