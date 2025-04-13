<?php
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Dashboard\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\PostController;

Route::redirect('/', '/home');

Route::name('auth.')->group(function(){

    Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('index');
    Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login');
    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');
    
    Route::get('/registro', [RegisterController::class, 'index'])->name('register.index');
    Route::post('/registro', [RegisterController::class, 'store'])->name('register.store');
    
    Route::middleware('guest')->group(function(){
    
        Route::get('/olvide-contrasena', [ResetPasswordController::class, 'index'])->name('forgot-password.index');
        Route::post('/olvide-contrasena', [ResetPasswordController::class, 'send'])->name('forgot-password.send');
    
        Route::get('/restablecer-contrasena/{token}', [ResetPasswordController::class, 'recoverIndex'])->name('password.reset');
        Route::post('/restablecer-contrasena', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

});

Route::name('dashboard.')->middleware('auth')->group(function(){

    Route::get('/home', [HomeController::class, 'index'])->name('home'); 
    Route::get('/home/users', [HomeController::class, 'showUsers'])->name('show-users');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    Route::resource('/posts', PostController::class);

    Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});







