<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // Store a newly created comment
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
    
        if ($request->ajax()) {
            // Render the comment partial view
            $html = view('partials.comment', ['comment' => $comment])->render();
            return response()->json(['html' => $html]);
        }
    
        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    // Show the form for editing a comment
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return response()->json(['comment' => $comment]);
    }

    // Update the specified comment
    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }
    
        $request->validate([
            'content' => 'required|string|max:500',
        ]);
    
        $comment->update([
            'content' => $request->content,
        ]);
    
        if ($request->ajax()) {
            // Render the updated comment partial
            $html = view('partials.comment', ['comment' => $comment])->render();
            return response()->json(['html' => $html]);
        }
    
        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // Delete the specified comment
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        // Ensure the authenticated user owns the comment
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Comment deleted successfully']);
        }

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}