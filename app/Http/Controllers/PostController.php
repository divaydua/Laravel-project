<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    //
       // Display paginated posts
      
       public function index()
       {
           // Fetch all posts with their likes and users
           $posts = Post::with(['user', 'likes', 'comments.user'])->paginate(10); // Load comments with their users
           
           return view('posts.index', compact('posts'));
       }

       // Show the form for creating a new post
       public function create()
       {
           return view('posts.create');
       }
   
       public function store(Request $request, $postId)
{
    dd($postId); // Inspect the post ID being passed to the method

    $post = Post::findOrFail($postId);

    $request->validate([
        'content' => 'required|string|max:500',
    ]);

    $post->comments()->create([
        'content' => $request->content,
        'user_id' => auth()->id(),
    ]);

    return redirect()->route('posts.index')->with('success', 'Comment added successfully.');
}
   
      
       // Update the specified post in the database
       public function update(Request $request, Post $post)
       {
           $request->validate([
               'title' => 'required|max:255',
               'content' => 'required',
           ]);
   
           $post->update($request->all());
   
           return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
       }
   
       public function edit(Post $post)
    {
    // Ensure the user is authorized to edit the post
    if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    return view('posts.edit', compact('post'));
    }  

    public function destroy(Post $post)
    {
    // Ensure the user is authorized to delete the post
    if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
        abort(403, 'Unauthorized action.');
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}
