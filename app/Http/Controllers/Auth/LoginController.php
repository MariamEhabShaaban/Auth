<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{
     public function __invoke(LoginRequest $request)
    {
       
        if(Auth::attempt($request->only('email','password'))){
            if(Auth::user()->email_veriifed_at){
            return to_route('profile')->with('success','You Logged-In Successully');
            }
            $otp = rand(100000,999999);
            Auth::user()->otp = $otp;
            Auth::user()->save();
            Mail::to($request->email)->send(new VerifyAccount($otp));
            return to_route('verify-email',['email'=>$request->email])->with('error','Please verify your account');
        }

        return to_route('login')->with('error','Password Or Email Incorrect');
    }
}
