<?php

namespace App\Http\Requests\Ward;

use Illuminate\Foundation\Http\FormRequest;

class CreateWardRequest extends FormRequest
{

    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'district_id' => ['required']
        ];
    }
}
