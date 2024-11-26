<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\PostController;

Route::resource('posts', PostController::class);

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