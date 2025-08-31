<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendResetLinkEmail;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class ForgotPasswordController extends Controller
{

    public function __invoke(ForgotPasswordRequest $request)
    {
        $token = Str::random(60);
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email'=>$request->email],
            ['token'=>$token,'created_at'=>now()]
        );
     Mail::to($request->email)->send(new SendResetLinkEmail($token));

     return back()->with('success','Reset Email Sent Successfully');
    } 
}
