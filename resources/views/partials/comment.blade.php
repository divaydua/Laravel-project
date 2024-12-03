<li class="flex items-start space-x-4 mb-4">
    <div>
        <p class="text-sm font-bold">{{ $comment->user->name }}</p>
        <p class="text-gray-600">{{ $comment->content }}</p>

        <!-- Edit and Delete Buttons -->
        @if ($comment->user_id === auth()->id())
            <div class="mt-2 flex items-center space-x-4">
                <a href="{{ route('comments.edit', $comment->id) }}" class="text-blue-500 hover:text-blue-700 font-bold">
                    Edit
                </a>
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