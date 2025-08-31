<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Mail\VerifyAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    
    public function __invoke(RegisterRequest $request)
    {
        $otp = rand(100000,999999);
        $data = $request->all();
        $data['otp']=$otp;
        $data['password'] = Hash::make($data['password']);
        try {
            Mail::to($user->email)->send(new WelcomeMail($user));
             $user = User::create($data);
             return to_route('verify-email',['email'=>$user->email])->with('success','Account created successfully');
        } catch (\Exception $e) {
            return to_route('register')->with('error','check your internet connection');
        }
       
        }
        
    }

