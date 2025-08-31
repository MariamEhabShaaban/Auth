<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ChangePasswordRequest;

class ChangePasswordController extends Controller
{
     public function __invoke(ChangePasswordRequest $request)
    {
        $hashedValue = Auth::user()->password;
        if(!Hash::check($request->current_password, $hashedValue))
            return back()->with('error','Current Password Incorrect');

        Auth::user()->update(['password'=>Hash::make($request->new_password)]);
        Auth::login(Auth::user());
        return back()->with('success','Password Changed Successully');

    }
}
