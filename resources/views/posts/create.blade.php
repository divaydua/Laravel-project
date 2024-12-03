@extends('layouts.app')

@section('title', 'Create New Post')

@section('content')
<div class="max-w-4xl mx-auto mt-10">
    <!-- Page Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Create a New Post</h1>

    <!-- Form Container -->
    <div class="bg-white shadow-md rounded-lg p-8">
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Title Input -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input 
                    type="text" 
                    name="title" 
                    id="title" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm p-2"
                    placeholder="Enter your post title"
                    value="{{ old('title') }}" 
                    required>
                @error('title')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content Input -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="5" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-gray-500 focus:border-gray-500 sm:text-sm p-2"
                    placeholder="Write something amazing..."
                    required>{{ old('content') }}</textarea>
                @error('content')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload an Image (Optional)</label>
                <input 
                    type="file" 
                    name="image" 
                    id="image" 
                    class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm cursor-pointer focus:ring-gray-500 focus:border-gray-500"
                    accept="image/*">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="text-left">
                <button 
                    type="submit" 
                    class="bg-gray-800 text-white font-semibold px-6 py-2 rounded-md shadow hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                    Publish Post
                </button>
            </div>
        </form>
    </div>
</div>
@endsection