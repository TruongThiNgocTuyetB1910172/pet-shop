<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateClientRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'user_id' => ['required'],
            'user_name' => ['required','string'],
            'house_number' => ['required','string'],
            'address' => ['required','string'],
            'ward_id' => ['required'],
            'district_id' => ['required'],
            'province_id' => ['required'],
            'phone_number'=> ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
        ];
    }
}
