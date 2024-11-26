<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);

use App\Http\Controllers\CommentController;

// Comments routes for a specific post
Route::get('/posts/{postId}/comments', [CommentController::class, 'index'])->name('comments.index');
Route::get('/posts/{postId}/comments/create', [CommentController::class, 'create'])->name('comments.create');
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

use App\Http\Controllers\LikeController;

// Routes for liking and unliking posts
Route::post('/posts/{postId}/like', [LikeController::class, 'likePost'])->name('posts.like');
Route::delete('/posts/{postId}/unlike', [LikeController::class, 'unlikePost'])->name('posts.unlike');

// Routes for liking and unliking comments
Route::post('/comments/{commentId}/like', [LikeController::class, 'likeComment'])->name('comments.like');
Route::delete('/comments/{commentId}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');

Route::get('/db-test', function () {
    try {
        DB::connection()->getPdo();
        return "Database connection is working.";
    } catch (\Exception $e) {
        return "Could not connect to the database. Error: " . $e->getMessage();
    }
});
// Route for displaying all users
Route::get('/users', [UserController::class, 'index'])->name('users.index');

// Route for displaying a single user
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');

// Profile routes
Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
Route::get('/profiles/create', [ProfileController::class, 'create'])->name('profiles.create');
Route::post('/profiles', [ProfileController::class, 'store'])->name('profiles.store');
Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');
Route::put('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::delete('/profiles/{id}', [ProfileController::class, 'destroy'])->name('profiles.destroy');

Route::get('/food', function () {
    return view('food');
});

Route ::get('/home', function(){
    return view('home');
});