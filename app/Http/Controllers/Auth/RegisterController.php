<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    
    public function __invoke(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create($validated);
        Auth::login($user);
        return to_route('profile')->with('success','Account created successfully');
    }
}
