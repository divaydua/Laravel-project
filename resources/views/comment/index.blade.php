@extends('layouts.app')

@section('title', 'Comments')

@section('content')
<h1>Comments for "{{ $post->title }}"</h1>

<a href="{{ route('comments.create', $post->id) }}" class="btn btn-primary">Add Comment</a>

@if ($comments->isEmpty())
    <p>No comments yet. Be the first to comment!</p>
@else
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
@endif
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    const commentForms = document.querySelectorAll('.comment-form');

    commentForms.forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const postId = form.dataset.postId;
            const formData = new FormData(form);
            const commentsList = document.querySelector(`#comments-list-${postId}`);

            fetch(`/posts/${postId}/comments`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                if (data.comment) {
                    const newComment = document.createElement('li');
                    newComment.innerHTML = `
                        <p>${data.comment.content}</p>
                        <p><strong>By:</strong> ${data.comment.user.name}</p>
                    `;
                    commentsList.prepend(newComment);
                    form.querySelector('textarea').value = '';
                } else {
                    alert('Failed to add comment.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>