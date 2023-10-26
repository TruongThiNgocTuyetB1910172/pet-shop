<?php

namespace App\Http\Requests\Shipper;

use Illuminate\Foundation\Http\FormRequest;

class CreateShipperRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required','string', 'unique:users'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'image' => ['nullable'],
            'password' => ['required', 'string', 'min:8', 'max:32'],
            'status' => ['required', 'in:0,1'],
            'gender' => ['required', 'in:0,1'],
        ];
    }
}
