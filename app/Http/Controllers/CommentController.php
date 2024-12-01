<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Display a listing of comments for a specific post

    public function store(Request $request, $postId)
    {
    $post = Post::findOrFail($postId);

    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $comment = $post->comments()->create([
        'content' => $request->content,
        'user_id' => auth()->id(),
    ]);

    // Return JSON response for AJAX
    if ($request->ajax()) {
        return response()->json([
            'message' => 'Comment added successfully.',
            'comment' => $comment->load('user'),
        ]);
    }

    return redirect()->back()->with('success', 'Comment added successfully.');
}

public function edit($id)
{
    $comment = Comment::findOrFail($id);

    // Ensure only the owner can edit
    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('comment.edit', compact('comment'));
}

public function update(Request $request, $id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $comment->update(['content' => $request->content]);

    return redirect()->route('comment.index', $comment->post_id)
                     ->with('success', 'Comment updated successfully.');
}

public function destroy($id)
{
    $comment = Comment::findOrFail($id);

    if ($comment->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $comment->delete();

    return redirect()->route('comment.index', $comment->post_id)
                     ->with('success', 'Comment deleted successfully.');
}
}