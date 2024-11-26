@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <h1>Edit Comment</h1>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $comment->content }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Comment</button>
    </form>
@endsection