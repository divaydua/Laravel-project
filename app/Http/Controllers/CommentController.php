<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Notification;
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

        // Create notification if the commenter is not the post owner
        if (auth()->id() !== $post->user_id) {
            Notification::create([
                'sender_id' => auth()->id(),
                'receiver_id' => $post->user_id,
                'type' => 'comment',
                'message' => auth()->user()->name . ' commented on your post.',
                'is_read' => false,
            ]);
        }

        if ($request->ajax()) {
            $html = view('partials.comment', compact('comment'))->render();
            return response()->json(['message' => 'Comment added successfully.', 'html' => $html]);
        }

        return redirect()->back()->with('success', 'Comment added successfully.');
    }

    // Show the form for editing a comment
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return response()->json(['comment' => $comment]);
    }

    // Update the specified comment
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

        if ($request->ajax()) {
            $html = view('partials.comment', compact('comment'))->render();
            return response()->json(['message' => 'Comment updated successfully.', 'html' => $html]);
        }

        return redirect()->back()->with('success', 'Comment updated successfully.');
    }

    // Delete the specified comment
    public function destroy(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $comment->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Comment deleted successfully.']);
        }

        return redirect()->back()->with('success', 'Comment deleted successfully.');
    }
}