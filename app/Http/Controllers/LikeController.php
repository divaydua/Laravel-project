<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Add a like to a post
    public function likePost($postId)
    {
        $post = Post::findOrFail($postId);

        // Check if the authenticated user has already liked the post
        if ($post->likes()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already liked this post.');
        }

        $post->likes()->create(['user_id' => auth()->id()]);

        if (request()->ajax()) {
            return response()->json(['message' => 'Liked successfully', 'likesCount' => $post->likes->count()]);
        }

        return redirect()->back()->with('success', 'Post liked successfully.');
    }

    // Remove a like from a post
    public function unlikePost($postId)
    {
        $post = Post::findOrFail($postId);

        $like = $post->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            return redirect()->back()->with('error', 'You have not liked this post.');
        }

        $like->delete();

        if (request()->ajax()) {
            return response()->json(['message' => 'Unliked successfully', 'likesCount' => $post->likes->count()]);
        }

        return redirect()->back()->with('success', 'Post unliked successfully.');
    }

    // Add a like to a comment
    public function likeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        if ($comment->likes()->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already liked this comment.');
        }

        $comment->likes()->create(['user_id' => auth()->id()]);

        return redirect()->back()->with('success', 'Comment liked successfully.');
    }

    // Remove a like from a comment
    public function unlikeComment($commentId)
    {
        $comment = Comment::findOrFail($commentId);

        $like = $comment->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            return redirect()->back()->with('error', 'You have not liked this comment.');
        }

        $like->delete();

        return redirect()->back()->with('success', 'Comment unliked successfully.');
    }
}