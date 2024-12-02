<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});

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

// Authentication Routes
require __DIR__.'/auth.php';