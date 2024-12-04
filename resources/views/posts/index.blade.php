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
                    <a href="{{ route('users.show', $post->user->id) }}" class="font-bold text-gray-800 hover:underline">
                     {{ $post->user->name }}
                        </a>
                        <p class="text-sm text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>

<!-- Post Content -->
<div class="p-6">
    @if ($post->image)    
        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="w-40 h-40 h-auto rounded-lg mb-4">
    @else
        <p>No image available for this post.</p>
    @endif
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
                                <li id="comment-{{ $comment->id }}" class="flex items-start space-x-4 mb-4">
                                    
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

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // AJAX for likes
    document.querySelectorAll('.like-button').forEach(button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const postId = button.getAttribute('data-post-id');
            const action = button.getAttribute('data-action');
            const url = action === 'like' ? `/posts/${postId}/like` : `/posts/${postId}/unlike`;

            try {
                const response = await fetch(url, {
                    method: action === 'like' ? 'POST' : 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                });

                if (response.ok) {
                    const html = await response.text();
                    document.getElementById(`like-section-${postId}`).innerHTML = html;
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    });
    //comments
    document.querySelectorAll('.comment-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const postId = form.getAttribute('data-post-id');
        const content = form.querySelector('textarea').value;

        try {
            const response = await fetch(`/posts/${postId}/comments`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ content }),
            });

            if (response.ok) {
                const data = await response.json();

                // Append the new comment's HTML to the comments section
                const commentsSection = document.getElementById(`comments-section-${postId}`);
                commentsSection.insertAdjacentHTML('beforeend', data.html);

                // Reset the form
                form.reset();
            } else {
                console.error('Failed to add comment:', await response.json());
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
//edit comment
document.querySelectorAll('.edit-comment-form').forEach(form => {
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const commentId = form.getAttribute('data-comment-id');
        const content = form.querySelector('textarea').value;

        try {
            const response = await fetch(`/comments/${commentId}`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ content }),
            });

            if (response.ok) {
                const data = await response.json();

                // Replace the comment HTML with the updated one
                const commentElement = document.getElementById(`comment-${commentId}`);
                commentElement.outerHTML = data.html;

                // Optionally, close the edit form if displayed in a modal
            } else {
                console.error('Failed to update comment:', await response.json());
            }
        } catch (error) {
            console.error('Error:', error);
        }
    });
});
</script>
@endsection