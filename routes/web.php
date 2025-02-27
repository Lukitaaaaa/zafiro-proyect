<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;

Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('auth.index');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('auth.login');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('auth.logout');

Route::get('/registro', [RegisterController::class, 'index'])->name('auth.register.index');
Route::post('/registro', [RegisterController::class, 'store'])->name('auth.register.store');

Route::middleware('guest')->group(function(){

    Route::get('/olvide-contrasena', [ResetPasswordController::class, 'index'])->name('auth.forgot-password.index');
    Route::post('/olvide-contrasena', [ResetPasswordController::class, 'send'])->name('auth.forgot-password.send');

    Route::get('/restablecer-contrasena/{token}', [ResetPasswordController::class, 'recoverIndex'])->name('password.reset');
    Route::post('/restablecer-contrasena', [ResetPasswordController::class, 'reset'])->name('password.update');
});



Route::get('/dashboard', fn () => view('welcome'))->name('dashboard');

Route::get('/home', [HomeController::class, 'index'])->name('home'); 

Route::get('/profile', [DashboardController::class, 'index'])->name('profile');

Route::resource('/posts', PostController::class);
