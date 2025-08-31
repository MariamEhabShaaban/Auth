<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\ResetPasswordRequest;

class ResetPasswordController extends Controller
{
   
    public function __invoke(ResetPasswordRequest $request)
    {
        $result =    DB::table('password_reset_tokens')->where(
            'email',$request->email)->where(
            'token' , $request->token)->first();
       if(!$result){
            return back()->with('error','This Email Not Found');
            }

         DB::table('password_reset_tokens')->where(
            'email',$request->email)->delete();
        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);
    
      return to_route("login")->with("success", 'Password reset successfully, you can login now');
         }
}
