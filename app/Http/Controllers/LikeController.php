<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Notification;
use Illuminate\Http\Request;

class LikeController extends Controller
{
   // Add a like to a post or comment
   public function like($type, $id)
   {
    //    $model = $this->getModel($type, $id);

    //    // Check if the authenticated user has already liked
    //    if ($model->likes()->where('user_id', auth()->id())->exists()) {
    //        return redirect()->back()->with('error', 'Already liked');
    //    }

    //    // Create a like
    //    $model->likes()->create(['user_id' => auth()->id()]);

    //    // Send notification
    //    if ($type === 'post') {
    //        $receiverId = $model->user_id; // For posts
    //    } elseif ($type === 'comment') {
    //        $receiverId = $model->user_id; // For comments
    //    }

    //    if ($receiverId !== auth()->id()) {
    //        Notification::create([
    //            'sender_id' => auth()->id(),
    //            'receiver_id' => $receiverId,
    //            'type' => 'like',
    //            'message' => auth()->user()->name . ' liked your ' . $type,
    //        ]);
    //    }

    //    return redirect()->back()->with('success', ucfirst($type) . ' liked successfully.');

    $model = $type === 'post' ? Post::findOrFail($id) : Comment::findOrFail($id);

    // Check if already liked
    if ($model->likes()->where('user_id', auth()->id())->exists()) {
        return response()->json(['error' => 'Already liked'], 400);
    }

    // Add a like
    $model->likes()->create(['user_id' => auth()->id()]);

    // Send notification
    if ($type === 'post') {
        $receiverId = $model->user_id;
    } elseif ($type === 'comment') {
        $receiverId = $model->user_id;
    }

    if ($receiverId !== auth()->id()) {
        Notification::create([
            'sender_id' => auth()->id(),
            'receiver_id' => $receiverId,
            'type' => 'like',
            'message' => auth()->user()->name . ' liked your ' . $type . '.',
        ]);
    }

    return response()->json(['message' => 'Liked successfully', 'likesCount' => $model->likes()->count()]);

   }

   // Remove a like from a post or comment
   public function unlike($type, $id)
   {
    //    $model = $this->getModel($type, $id);

    //    $like = $model->likes()->where('user_id', auth()->id())->first();

    //    if (!$like) {
    //        return redirect()->back()->with('error', 'Not liked yet');
    //    }

    //    $like->delete();

    //    return redirect()->back()->with('success', ucfirst($type) . ' unliked successfully.');
    $model = $type === 'post' ? Post::findOrFail($id) : Comment::findOrFail($id);

    $like = $model->likes()->where('user_id', auth()->id())->first();

    if (!$like) {
        return response()->json(['error' => 'Not liked yet'], 400);
    }

    // Remove like
    $like->delete();

    return response()->json(['message' => 'Unliked successfully', 'likesCount' => $model->likes()->count()]);
   }

   private function getModel($type, $id)
   {
       if ($type === 'post') {
           return Post::findOrFail($id);
       } elseif ($type === 'comment') {
           return Comment::findOrFail($id);
       }

       abort(404, 'Invalid type');
   }
}