@extends('layouts.app')

@section('title', 'Your Homepage')

@section('content')
<div class="space-y-8">
    <!-- Dashboard Heading -->
    <div class="py-6">
        <h1 class="text-6xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-800 to-blue-500">
            <span style="font-family: 'Georgia', serif;">YOUR SOCIAL MEDIA FEED</span>
        </h1>
    </div>
</div>
    
    <!-- Create new post button -->
    <div class="text-right">
        <a href="{{ route('posts.create') }}" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md shadow">
            + Create New Post
        </a>
    </div>

    <!-- Posts list -->
    @if ($posts->isEmpty())
        <p class="text-gray-500 text-center">No posts found! Be the first to create a post.</p>
    @else
        @foreach ($posts as $post)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <!-- Post Header -->
                <div class="flex items-center px-6 py-4 border-b">
                <img src="{{ $post->user->profile_picture ? asset('storage/' . $post->user->profile_picture) : '/images/default-avatar.jpg' }}" alt="User Avatar" class="h-9 w-13 rounded-full object-cover border border-gray-300 shadow-sm">
                    <div class="ml-4">
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="font-bold text-gray-800 hover:underline">
                            {{ $post->user->name }}
                        </a>
                        <p class="text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

                <!-- Post Content -->
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800">{{ $post->title }}</h3>
                    <p class="text-gray-600 mt-2">{{ $post->content }}</p>
                </div>

                <!-- Post Actions -->
                <div class="flex items-center px-6 py-4 border-t bg-gray-50">
                    <!-- Like Button -->
                    <form action="{{ route('posts.like', $post->id) }}" method="POST" class="mr-4">
                        @csrf
                        <button class="flex items-center space-x-2 text-gray-800 hover:text-gray-900">
                            <img src="/images/blue-like-button-icon.svg" alt="Like" class="h-5 w-5">
                        </button>
                    </form>

                    <div class="text-sm text-gray-600 flex items-center">
                        <span class="text-gray-800">{{ $post->likes->count() }}</span>
                        <span class="ml-2">Like</span>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="p-6 bg-gray-50">
                    <h4 class="font-semibold text-gray-800 mb-2">Comments</h4>

                    <!-- Display Comments -->
                    @if ($post->comments->isEmpty())
                        <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($post->comments as $comment)
                                <li class="flex items-start space-x-4 mb-4">
                                    
                                    <div>
                                        <p class="text-sm font-bold">{{ $comment->user->name }}</p>
                                        <p class="text-gray-600">{{ $comment->content }}</p>

                                        <!-- Edit and Delete Buttons -->
                                        @if ($comment->user_id === auth()->id())
                                            <div class="mt-2 flex items-center space-x-4">
                                                <!-- Edit Button -->
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-500 hover:text-blue-700 font-bold">
                                                    Edit
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500 hover:text-red-700 font-bold" onclick="return confirm('Are you sure?')">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <!-- Add Comment -->
                    <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
                        @csrf
                        <textarea name="content" class="w-full px-4 py-2 border rounded-md focus:outline-none" rows="2" placeholder="Add a comment..." required></textarea>
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded-md mt-2">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        @endforeach

        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection