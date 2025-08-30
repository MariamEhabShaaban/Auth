<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;


class LoginController extends Controller
{
     public function __invoke(LoginRequest $request)
    {
        $user = $request->validated();
        if(Auth::attempt($request->only('email','password'))){
            return to_route('profile')->with('success','You Logged Successully');
        }

        return redirect('/');
    }
}
