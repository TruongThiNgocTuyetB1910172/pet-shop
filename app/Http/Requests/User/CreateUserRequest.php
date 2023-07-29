<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{

    public function rules(): array|string
    {
        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required','string'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'password' => ['required','min:8'],
            'is_admin' => ['required'],

        ];
    }
}
