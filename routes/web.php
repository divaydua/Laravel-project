<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\LikeController;

Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');


Route::get('/posts', [PostController::class, 'index'])->name('posts.index');



Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->middleware(['auth'])->name('comments.store');
// Public Route: Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Protected Route: Dashboard (requires authentication and email verification)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Protected Routes: Posts, Comments, and Profiles (requires authentication)
Route::middleware('auth')->group(function () {
    // Post routes
    Route::resource('posts', PostController::class);

    // Comment routes
    Route::resource('comments', CommentController::class)->except(['create']);

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Authentication Routes (Laravel Breeze or custom setup)
// Make sure these are properly set in `auth.php` or use Laravel Breeze's setup.
require __DIR__.'/auth.php';