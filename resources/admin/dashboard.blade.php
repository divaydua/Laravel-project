@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="py-6">
    <h1 class="text-4xl font-bold">Admin Dashboard</h1>
    <p>Welcome, {{ auth()->user()->name }}! Here's an overview of the platform:</p>
    
    <div class="mt-6">
        <h2 class="text-2xl font-semibold">Statistics</h2>
        <ul class="list-disc list-inside">
            <li>Total Users: {{ $users->count() }}</li>
            <li>Total Posts: {{ $posts->count() }}</li>
            <li>Total Comments: {{ $comments->count() }}</li>
        </ul>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.posts') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Manage Posts</a>
        <a href="{{ route('admin.users') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Manage Users</a>
    </div>
</div>
@endsection