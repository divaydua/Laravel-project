@extends('layouts.app')

@section('title')
    {{ auth()->user()->name }}'s Homepage
@endsection

@section('title', 'All Posts')

@section('content')
<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <!-- Create new post button -->
    <div class="mb-6 text-right">
    <a href="{{ route('posts.create') }}" class="bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-gray-900">
    + Create New Post
    </a>
    </div>

    <h1 class="text-4xl font-extrabold mb-8 text-gray-800 border-b-2 border-gray-300 pb-4">
        All Posts
    </h1>

    <!-- Posts list -->
    @if ($posts->isEmpty())
        <p class="text-gray-600 italic">No posts found! Be the first to create one.</p>
    @else
        <div class="space-y-8">
            @foreach ($posts as $post)
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <!-- User's name with profile link -->
                    <p class="text-blue-600 font-bold text-lg">
                        <a href="{{ route('profiles.show', $post->user->id) }}" class="hover:underline">
                            {{ $post->user->name }}
                        </a>
                    </p>

                    <!-- Post content -->
                    <h3 class="text-2xl font-semibold text-gray-800 mt-2">{{ $post->title }}</h3>
                    <p class="text-gray-700 mt-4 leading-relaxed">{{ $post->content }}</p>

                    <!-- Like/Unlike Button -->
                    <div class="flex items-center mt-6 space-x-4">
                        @if ($post->likes->where('user_id', auth()->id())->count())
                            <form action="{{ route('posts.unlike', $post->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="flex items-center space-x-2 text-red-600 hover:text-red-800 font-bold">
                                    <img src="{{ asset('/images/blue-like-button-icon.svg') }}" alt="Unlike" class="h-6 w-6">
                                    <span>Unlike</span>
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.like', $post->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="flex items-center space-x-2 text-blue-600 hover:text-blue-800 font-bold">
                                    <img src="{{ asset('/images/blue-like-button-icon.svg') }}" alt="Like" class="h-6 w-6">
                                    <span>Like</span>
                                </button>
                            </form>
                        @endif
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-8">
                        <h4 class="font-bold text-lg text-gray-900 mb-4">Comments</h4>

                        <!-- Display Comments -->
                        @if ($post->comments->isEmpty())
                            <p class="text-gray-500 italic">No comments yet. Be the first to comment!</p>
                        @else
                            <ul class="space-y-4">
                                @foreach ($post->comments as $comment)
                                    <li class="bg-gray-100 p-4 rounded-lg shadow">
                                        <p class="text-gray-800">{{ $comment->content }}</p>
                                        <p class="text-sm text-gray-500 mt-2">Posted by {{ $comment->user->name }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif

                        <!-- Add Comment Form -->
                        <form action="{{ route('comments.store', $post->id) }}" method="POST" class="mt-6">
                            @csrf
                            <textarea name="content" class="w-full p-4 border rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Write a comment..." required></textarea>
                            <button type="submit" class="bg-gray-800 text-white font-bold py-3 px-6 rounded-lg shadow hover:bg-gray-900 mt-4">
    Submit
</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection