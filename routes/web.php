<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

use App\Http\Controllers\ImageUploadController;


//Notification
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image.upload');
// Like/Unlike Routes
Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');

// Post Routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Profile Routes
Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');

// Comment Routes (Nested)
Route::prefix('posts/{post}')->middleware(['auth'])->group(function () {
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (Authenticated)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile Management
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Edit Comment
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->middleware(['auth'])->name('comments.edit');

// Update Comment
Route::put('/comments/{id}', [CommentController::class, 'update'])->middleware(['auth'])->name('comments.update');

// Delete Comment
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware(['auth'])->name('comments.destroy');

//Like

// Like routes for comments
Route::post('/comments/{comment}/like', [LikeController::class, 'likeComment'])->name('comments.like');
Route::delete('/comments/{comment}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');

Route::post('/posts/{post}/like', [LikeController::class, 'likePost'])->name('posts.like');
Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlikePost'])->name('posts.unlike');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Authentication Routes
require __DIR__.'/auth.php';