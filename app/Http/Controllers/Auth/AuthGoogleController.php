<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthGoogleController extends Controller
{
   public function callback(){
        $GoogleUser = Socialite::driver('google')->user();
        $user = User::firstOrCreate(
            ['email'=>$GoogleUser->getEmail()],
            [
                'name'=>$GoogleUser->getName(),
                'password'=>Hash::make(Str::random(16)),
                'email_verified_at'=>now()

            ]
        );
        Auth::login($user);
        return to_route('profile')->with('success','You logged in');
   }

    public function redirect(){
     return Socialite::driver('google')->redirect();
   }
}
