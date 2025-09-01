<?php

namespace App\Http\Controllers\Auth;

use App\Models\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }

     public function logout_device(Request $request,Session $session)
    {
        $session->delete();

        return back();
    }
}
