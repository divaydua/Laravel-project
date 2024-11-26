@extends('layouts.app')

@section('title', 'Comments')

@section('content')
    <h1>Comments for "{{ $post->title }}"</h1>

    <a href="{{ route('comments.create', $post->id) }}" class="btn btn-primary">Add Comment</a>

    @if ($comment->likes->where('user_id', auth()->id())->count())
    <form action="{{ route('comments.unlike', $comment->id) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Unlike</button>
    </form>
    @else
    <form action="{{ route('comments.like', $comment->id) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary">Like</button>
    </form>
    @endif

    <ul>
        @foreach ($comments as $comment)
            <li>
                <p>{{ $comment->content }}</p>
                <p><strong>By:</strong> {{ $comment->user->name }}</p>
                <p>
                    <a href="{{ route('comments.edit', $comment->id) }}">Edit</a>
                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </p>
            </li>
        @endforeach
    </ul>

    {{ $comments->links() }}
@endsection