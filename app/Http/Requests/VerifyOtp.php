<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtp extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'email'=>"required|email|exists:users,email",
            'otp'=>'required|array|size:6',
            'otp.*'=>'required|numeric|digits:1'
        ];
    }
}
