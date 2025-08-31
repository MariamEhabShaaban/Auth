<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\VerifyOtp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class VerifyAccount extends Controller
{

    public function __invoke(VerifyOtp $request)
    {
       $otp = implode('',$request->otp);
       $user = User::where('email',$request->email)->where('otp',$otp)->first();;
       if(!$user){
        return back()->with('error','Email or OTP is invalid');
       }
       $user->update(['email_verified_at'=>now()]);
       Auth::login($user);
       return to_route('profile')->with('success','Login successfully');
    }
}
