<li id="comment-{{ $comment->id }}" class="flex flex-col mb-4 border-b border-gray-200 pb-4">
    <div>
        <p class="text-sm font-bold">{{ $comment->user->name }}</p>
        <p class="text-gray-600">{{ $comment->content }}</p>
    </div>

    <!-- Like Section for Comment -->
    <div id="like-section-comment-{{ $comment->id }}" class="mt-2">
        <button 
            class="like-button flex items-center space-x-2 text-gray-800 hover:text-gray-900" 
            data-id="{{ $comment->id }}" 
            data-type="comment"
            data-action="{{ $comment->likes->contains('user_id', auth()->id()) ? 'unlike' : 'like' }}">
            <img src="/images/like.avif" alt="Like" class="h-5 w-5">
            <span class="ml-2">{{ $comment->likes->contains('user_id', auth()->id()) ? 'Unlike' : 'Like' }}</span>
        </button>
        <div class="text-sm text-gray-600 flex items-center mt-1">
            <span class="text-gray-800 like-count">{{ $comment->likes->count() }}</span>
            <span class="ml-2">Likes</span>
        </div>
    </div>

    <!-- Edit/Delete Buttons -->
    @if ($comment->user_id === auth()->id())
        <div class="mt-2 flex items-center space-x-4">
            <a href="{{ route('comments.update', $comment->id) }}" class="mt-2 text-blue-500 hover:text-blue-700 font-bold space-x-4 ">Edit</a>
            <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" class="ml-4">
                @csrf
                @method('DELETE')
                <button type="submit" class="mt-2 text-red-500 hover:text-red-700 font-bold space-x-4">Delete</button>
            </form>
        </div>
    @endif
</li>