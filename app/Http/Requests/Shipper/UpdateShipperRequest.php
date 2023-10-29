<?php

namespace App\Http\Requests\Shipper;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShipperRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'gender' => ['required', 'in:0,1'],
            'status' => ['required', 'in:0,1'],
            'image' => ['nullable'],
        ];
    }
}
