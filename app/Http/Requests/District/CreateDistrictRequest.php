<?php

namespace App\Http\Requests\District;

use Illuminate\Foundation\Http\FormRequest;

class CreateDistrictRequest extends FormRequest
{
    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'province_id'=>['required'],
        ];
    }
}
