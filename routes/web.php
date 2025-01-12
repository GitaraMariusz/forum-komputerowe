<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\PostReportController;
use App\Http\Controllers\CommunityController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/forum', [ForumController::class, 'index'])->name('forum');
Route::get('/forum/thread/{thread}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/post/{post}/report', [PostReportController::class, 'store'])->name('post.report');


Route::prefix('forum')->name('forum.')->group(function () {
    Route::get('/', [ForumController::class, 'index'])->name('index');
    Route::get('/create', [ForumController::class, 'create'])->middleware('auth')->name('create');
    Route::post('/store', [ForumController::class, 'store'])->middleware('auth')->name('store');
});

Route::middleware('auth')->group(function () {
    Route::get('/community', [CommunityController::class, 'index'])->name('community.index'); // List of users
    Route::get('/community/{user}', [CommunityController::class, 'show'])->name('community.show'); // Show user's messages
    Route::post('/community/{user}/message', [CommunityController::class, 'sendMessage'])->name('community.sendMessage'); // Send a message
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
