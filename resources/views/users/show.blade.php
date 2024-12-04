@extends('layouts.app')

@section('title', "{$user->name}'s Profile")

@section('content')
<div class="max-w-7xl mx-auto py-8">
    <!-- User Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h1 class="text-3xl font-bold text-gray-800">{{ $user->name }}</h1>
        <p class="text-gray-500">Joined {{ $user->created_at->diffForHumans() }}</p>
    </div>

    <!-- User Posts -->
    <div class="space-y-8">
        <h2 class="text-2xl font-bold text-gray-800">Posts by {{ $user->name }}</h2>
        @if ($user->posts->isEmpty())
            <p class="text-gray-500">This user hasn't made any posts yet.</p>
        @else
            @foreach ($user->posts as $post)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 mt-2">{{ $post->content }}</p>
                    </div>
                    <div class="p-6 bg-gray-50">
                        <h4 class="font-semibold text-gray-800 mb-2">Comments</h4>
                        @if ($post->comments->isEmpty())
                            <p class="text-gray-500">No comments on this post yet.</p>
                        @else
                            <ul class="space-y-4">
                                @foreach ($post->comments as $comment)
                                    <li class="text-gray-600">
                                        <p>{{ $comment->content }}</p>
                                        <p class="text-sm text-gray-400">- {{ $comment->user->name }} ({{ $comment->created_at->diffForHumans() }})</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
@endsection