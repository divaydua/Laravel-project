<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;

class AdminController extends Controller
{
    // Ensure only admins can access this controller
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }

    // Admin Dashboard
    public function index()
    {
        $users = User::all();
        $posts = Post::all();
        $comments = Comment::all();

        return view('admin.dashboard', compact('users', 'posts', 'comments'));
    }

    // Example: Manage Posts
    public function managePosts()
    {
        $posts = Post::paginate(10);
        return view('admin.manage_posts', compact('posts'));
    }

    // Example: Manage Users
    public function manageUsers()
    {
        $users = User::paginate(10);
        return view('admin.manage_users', compact('users'));
    }
}