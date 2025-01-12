<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/thread/{thread}', [ForumController::class, 'show'])->name('forum.show');


Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/create', [ForumController::class, 'create'])->middleware('auth')->name('create');
    Route::post('/store', [ForumController::class, 'store'])->middleware('auth')->name('store');
});


Route::middleware('auth')->group(function () {
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/post/{post}/like', [PostLikeController::class, 'like'])->name('post.like');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
