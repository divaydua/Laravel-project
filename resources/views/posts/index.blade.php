@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <h1>All Posts</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

    @if ($posts->isEmpty())
        <p>No posts found!</p>
    @else
        <ul class="list-group">
            @foreach ($posts as $post)
                <li class="list-group-item">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ $post->content }}</p>
                    <div class="d-flex">
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm me-2">Edit</a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif

    <!-- Pagination links -->
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@endsection