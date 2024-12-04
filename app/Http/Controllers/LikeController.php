<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
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
        
         // Send notification to the post owner
        
        Notification::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $post->user_id,
            'type' => 'like',
            'message' => auth()->user()->name . ' liked your post.',
        ]);
    

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
    public function like($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);

        if ($item->likes()->where('user_id', auth()->id())->exists()) {
            return response()->json(['error' => 'Already liked'], 400);
        }

        $item->likes()->create(['user_id' => auth()->id()]);

        // Trigger Notification
        if ($item->user_id !== auth()->id()) { // Avoid self-notification
            $item->user->notifications()->create([
                'sender_id' => auth()->id(),
                'type' => 'like',
                'message' => 'Your ' . $type . ' was liked.',
            ]);
        }

        return response()->json(['likesCount' => $item->likes->count()]);
    }

    public function unlike($type, $id)
    {
        $model = $this->getModel($type);
        $item = $model::findOrFail($id);

        $like = $item->likes()->where('user_id', auth()->id())->first();

        if (!$like) {
            return response()->json(['error' => 'Not liked yet'], 400);
        }

        $like->delete();

        return response()->json(['likesCount' => $item->likes->count()]);
    }

    private function getModel($type)
    {
        $models = [
            'post' => Post::class,
            'comment' => Comment::class,
        ];

        return $models[$type] ?? abort(404, 'Invalid type');
    }
}