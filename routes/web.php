<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');

Route::view('/register', 'auth.register')->name('register');


Route::post('/register',RegisterController::class)->name('register');
Route::post('/login',LoginController::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'auth.profile')->name('profile');
    Route::post('/logout',LogoutController::class)->name('logout');

});



