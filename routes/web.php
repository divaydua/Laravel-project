<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/food', function () {
    return view('food');
});

Route ::get('/home', function(){
    return view('home');
});