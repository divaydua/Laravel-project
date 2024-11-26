@extends('layouts.app')

@section('title', 'Add Comment')

@section('content')
    <h1>Add Comment to "{{ $post->title }}"</h1>

    <form action="{{ route('comments.store', $post->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Comment</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
@endsection