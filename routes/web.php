<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyAccount;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AuthGoogleController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UpdateProfileController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::view('/', 'index');
Route::view('/login', 'auth.login')->name('login');

Route::view('/register', 'auth.register')->name('register');
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password',ForgotPasswordController::class)->name('password.email');
Route::view('/reset-password/{token}','auth.reset-password')->name('password.reset');
Route::post('/reset-password',ResetPasswordController::class)->name('password.update');
Route::view('/verify-email/{email}','auth.verify-email')->name('verify-email');
Route::post('/verify-email',VerifyAccount::class)->name('verify-update');
Route::get('/auth/google/callback',[AuthGoogleController::class,'callback'])->name('google.callback');
Route::get('/auth/google/redirect',[AuthGoogleController::class,'redirect'])->name('google.redirect');






Route::post('/register',RegisterController::class)->name('register');
Route::post('/login',LoginController::class)->name('login');

Route::middleware('auth')->group(function () {
    Route::view('/profile', 'auth.profile')->name('profile');
    Route::post('/logout',LogoutController::class)->name('logout');
    Route::put('/update-profile',UpdateProfileController::class)->name('update');
    Route::post('/change-password',ChangePasswordController::class)->name('change-password');


});



