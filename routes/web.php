<?php

use App\Models\Session;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyAccount;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\AuthGoogleController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\UpdateProfileController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;

Route::view('/', 'index');
// LOGIN ROUTES
Route::view('/login', 'auth.login')->name('login');
Route::post('/login',LoginController::class)->name('login');

// REGISTER ROUTES
Route::view('/register', 'auth.register')->name('register');
Route::post('/register',RegisterController::class)->name('register');

// FORGOT PASSWORD ROUTES
Route::view('/forgot-password', 'auth.forgot-password')->name('password.request');
Route::post('/forgot-password',ForgotPasswordController::class)->name('password.email');

// RESET PASSWORD ROUTES
Route::view('/reset-password/{token}','auth.reset-password')->name('password.reset');
Route::post('/reset-password',ResetPasswordController::class)->name('password.update');

// VERIY EMAIL ROUTES
Route::view('/verify-email/{email}','auth.verify-email')->name('verify-email');
Route::post('/verify-email',VerifyAccount::class)->name('verify-update');

// SOCIAL ROUTES
Route::get('/auth/google/callback',[AuthGoogleController::class,'callback'])->name('google.callback');
Route::get('/auth/google/redirect',[AuthGoogleController::class,'redirect'])->name('google.redirect');


// AUTH ROUTES
Route::middleware(['auth','auth.session'])->group(function () {
    Route::view('/profile', 'auth.profile')->name('profile');
    Route::post('/logout',[LogoutController::class,'logout'])->name('logout');
    Route::post('/logout/{session}',[LogoutController::class,'logout_device'])->name('logout_device');

    Route::put('/update-profile',UpdateProfileController::class)->name('update');
    Route::post('/change-password',ChangePasswordController::class)->name('change-password');


});


Route::get('/sessions',function(){
    return Session::all();
});



