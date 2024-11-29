@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">All Posts</h1>

    <!-- Create new post button -->
    <div class="mb-6">
        <a href="{{ route('posts.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">Create New Post</a>
    </div>

    <!-- Posts list -->
    @if ($posts->isEmpty())
        <p class="text-gray-500">No posts found!</p>
    @else
        <div class="space-y-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow-md rounded-lg p-6">
                    <!-- Post content -->
                    <h3 class="text-xl font-bold text-gray-800">{{ $post->title }}</h3>
                    <p class="text-gray-600 mt-2">{{ $post->content }}</p>
                    <p class="text-sm text-gray-400 mt-2">Posted by {{ $post->user->name }}</p>

                 <!-- Like/Unlike Button -->
<div class="flex items-center mt-4 space-x-4">
    @if ($post->likes->where('user_id', auth()->id())->count())
        <form action="{{ route('posts.unlike', $post->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-blue-500 hover:text-blue-600 hover:scale-110 transition-transform" aria-label="Like this post">
                <!-- Thumbs-Up Icon for Unlike -->
                <img src="{{ asset('images/blue-like-button-icon.svg') }}" alt="Like" class="h-6 w-6 hover:scale-110 transition-transform">
                <span>Unlike this post</span>
            </button>
        </form>
    @else
        <form action="{{ route('posts.like', $post->id) }}" method="POST">
            @csrf
            <button type="submit" class="text-blue-500 hover:text-blue-600 hover:scale-110 transition-transform" aria-label="Like this post">
                <!-- Thumbs-Up Icon for Like -->
                <img src="{{ asset('images/blue-like-button-icon.svg') }}" alt="Like" class="h-6 w-6 hover:scale-110 transition-transform">
                <span>Like this post</span>
            </button>
        </form>
    @endif
</div>

                    <!-- Comments Section -->
                    <div class="mt-6">
                        <h4 class="font-bold text-lg mb-4">Comments</h4>

                        <!-- Display Comments -->
                        @if ($post->comments->isEmpty())
                            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                        @else
                            <ul class="space-y-4">
                                @foreach ($post->comments as $comment)
                                    <li class="bg-gray-100 p-4 rounded">
                                        <p class="text-gray-600">{{ $comment->content }}</p>
                                        <p class="text-sm text-gray-400">Posted by {{ $comment->user->name }}</p>

                                        <!-- Edit and Delete options -->
                                        @if ($comment->user_id === auth()->id())
                                            <div class="flex space-x-2 mt-2">
                                                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-500">Edit</a>
                                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-500">Delete</button>
                                                </form>
                                            </div>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Add Comment Form -->
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-4">
                            @csrf
                            <textarea name="content" class="w-full p-2 border rounded" rows="3" placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mt-2">Comment</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection