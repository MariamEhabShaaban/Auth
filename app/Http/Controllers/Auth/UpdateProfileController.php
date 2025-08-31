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
        $data = $request->validated();
        $data['logout_other_devices'] = $request->logout_other_devices?true:false;
        Auth::user()->update($data);
        return to_route('profile')->with('success','Profile Updated Successfully');
    }
}
