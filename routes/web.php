<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\Dashboard\LikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PostController;

Route::redirect('/', '/home');

Route::name('auth.')->group(function () {

    Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('index');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

    Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

    Route::middleware('guest')->group(function () {

        Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot-password.index');
        Route::post('/forgot-password', [ResetPasswordController::class, 'send'])->name('forgot-password.send');

        Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
        Route::get('/reset-password/{token}', [ResetPasswordController::class, 'recoverIndex'])->name('password.reset');
    });

});

Route::name('dashboard.')->middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/home/users', [HomeController::class, 'showUsers'])->name('show-users');
    Route::get('/home/trending', [HomeController::class, 'showTrending'])->name('show-trending');
    Route::get('/explore', [HomeController::class, 'explore'])->name('explore');
    Route::get('/search-users', [HomeController::class, 'searchUsers'])->name('search-users');
    Route::get('/explore/tag/{tag:name}', [HomeController::class, 'postsByTag'])->name('explore.tag');
    Route::get('/liked-posts', [HomeController::class, 'likedPosts'])->name('posts-liked');
    Route::get('/notifications', [HomeController::class, 'notifications'])->name('notifications');
    Route::get('/settings', [HomeController::class, 'settings'])->name('settings');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user:username}', [ProfileController::class, 'index'])->name('profile');

    Route::post('/profile/{user:username}/follow', [ProfileController::class, 'follow'])->name('profile.follow');
    Route::post('/profile/{user:username}/unfollow', [ProfileController::class, 'unfollow'])->name('profile.unfollow');

    Route::resource('/posts', PostController::class)->except('index');

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::post('/comments/{comment}/reply', [CommentController::class, 'reply'])->name('comments.reply');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    Route::post('/posts/{post}/like', [LikeController::class, 'like'])->name('posts.like');
    Route::post('/posts/{post}/unlike', [LikeController::class, 'unlike'])->name('posts.unlike');
    Route::post('/posts/{post}/comments/{comment}/like', [LikeController::class, 'likeComment'])->name('comments.like');
    Route::post('/posts/{post}/comments/{comment}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');
});







