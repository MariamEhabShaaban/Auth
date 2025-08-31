<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\UpdateRequest;

class UpdateProfileController extends Controller
{

    public function __invoke(UpdateRequest $request)
    {
       Auth::user()->update($request->validated());
       return to_route('profile')->with('success','Profile Updated Successfully');
    }
}
