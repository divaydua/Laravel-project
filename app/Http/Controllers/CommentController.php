<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Display a listing of comments for a specific post
    public function index($postId)
    {
        $post = Post::findOrFail($postId);
        $comments = $post->comments()->paginate(10); // Paginated comments for the post

        return view('comments.index', compact('post', 'comments'));
    }

    // Show the form for creating a new comment
    public function create($postId)
    {
        $post = Post::findOrFail($postId);

        return view('comments.create', compact('post'));
    }

    // Store a newly created comment in the database
    public function store(Request $request, $postId)
    {
        $post = Post::findOrFail($postId);

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $post->comments()->create([
            'content' => $request->content,
            'user_id' => auth()->id(), // Assuming authentication is enabled
        ]);

        return redirect()->route('comments.index', $postId)
                         ->with('success', 'Comment added successfully.');
    }

    // Show the form for editing a comment
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment (optional)
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('comments.edit', compact('comment'));
    }

    // Update the specified comment in the database
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment (optional)
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'content' => 'required|string|max:500',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->route('comments.index', $comment->post_id)
                         ->with('success', 'Comment updated successfully.');
    }

    // Delete the specified comment
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment or is an admin (optional)
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        return redirect()->route('comments.index', $comment->post_id)
                         ->with('success', 'Comment deleted successfully.');
    }
}