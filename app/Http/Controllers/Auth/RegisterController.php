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
        $user = User::create($data);
        Mail::to($request->email)->send(new VerifyAccount($otp));
        return to_route('verify-email',['email'=>$user->email])->with('success','Account created successfully');
    }
}
