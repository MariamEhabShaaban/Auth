<?php

namespace App\Http\Requests\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $id = Auth::user()->id;
        return [
            'name'=>"required|string|max:255",
            'email'=>"required|email|unique:users,email,$id",
            'logout_other_devices'=>'nullable|in:on,off'
        ];
    }
}
