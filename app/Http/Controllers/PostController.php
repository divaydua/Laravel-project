<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Display paginated posts
    public function index()
    {
        // Fetch all posts with their relationships
        $posts = Post::with(['user', 'likes', 'comments.user'])->paginate(2);

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
            'title' => 'required|max:20',
            'content' => 'required',
            'image' => 'nullable|image|max:2048',
        ], [
            'title.required' => 'Please provide a title for your post.',
            'title.max' => 'The title cannot exceed 20 characters.',
            'content.required' => 'The post content cannot be empty.',
            'image.image' => 'The file must be a valid image format (jpg, png, etc.).',
            'image.max' => 'The image size must not exceed 2MB.',
        ]);
        // Prepare data for insertion
        $data = $request->only('title', 'content'); // Avoid using all(), as it may include unwanted fields
    
        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public'); // Store the image in 'storage/app/public/images'
        } else {
            $data['image'] = null; // Ensure this key is set, even if no image is provided
        }
    
        $data['user_id'] = auth()->id(); // Associate the post with the authenticated user

        // Create the post
        $post = Post::create($data);
    
        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $post->image = $request->file('image')->store('posts/images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $post->image, // Update the image path
        ]);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete the specified post
    public function destroy(Post $post)
    {
        // Ensure the user is authorized to delete the post
        if ($post->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the image if it exists
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }
}