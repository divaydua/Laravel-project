<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\QuoteController;

Route::get('/quotes/random', [QuoteController::class, 'randomQuote'])->name('quotes.random');
Route::get('/quotes/author/{author}', [QuoteController::class, 'quotesByAuthor'])->name('quotes.byAuthor');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
});


Route::middleware(['auth'])->group(function () {
    Route::get('/profiles', [ProfileController::class, 'index'])->name('profiles.index');
});

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');

//Notification
Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
Route::post('/notifications/mark-all-as-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.markAllAsRead');

Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image.upload');
// Like/Unlike Routes
Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');

Route::post('/like/{type}/{id}', [LikeController::class, 'like'])->name('like');
Route::delete('/unlike/{type}/{id}', [LikeController::class, 'unlike'])->name('unlike');
// Post Routes
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');


// Comment Routes (Nested)
// Route::prefix('posts/{post}')->middleware(['auth'])->group(function () {
//     Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
//     Route::get('/comments/{comment}/edit', [CommentController::class, 'edit'])->name('comments.edit');
//     Route::put('/comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
//     Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
// });

//Comments
Route::post('/comments/{postId}', [CommentController::class, 'store'])->name('comments.store');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

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
// Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->middleware(['auth'])->name('comments.edit');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profiles.edit');
// Update Comment
// Route::put('/comments/{id}', [CommentController::class, 'update'])->middleware(['auth'])->name('comments.update');

// Delete Comment
// Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->middleware(['auth'])->name('comments.destroy');

//Like

// Like routes for comments
//Route::post('/comments/{comment}/like', [LikeController::class, 'likeComment'])->name('comments.like');
//Route::delete('/comments/{comment}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');


// Likes for posts and comments
Route::post('/like/{type}/{id}', [LikeController::class, 'like'])->name('like');
Route::delete('/unlike/{type}/{id}', [LikeController::class, 'unlike'])->name('unlike');

Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/users', [UserController::class, 'index'])->name('users.index');
// Authentication Routes
require __DIR__.'/auth.php';