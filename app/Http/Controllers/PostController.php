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
   
       // Store a newly created post in the database
       public function store(Request $request)
       {
           $request->validate([
               'title' => 'required|max:255',
               'content' => 'required',
           ]);
   
           Post::create($request->all());
   
           return redirect()->route('posts.index')->with('success', 'Post created successfully.');
       }
   
       // Show the form for editing a post
       public function edit(Post $post)
       {
           return view('posts.edit', compact('post'));
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
   
       // Delete the specified post
       public function destroy(Post $post)
       {
           $post->delete();
   
           return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
       }
}
