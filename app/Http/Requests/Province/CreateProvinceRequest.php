<?php

namespace App\Http\Requests\Province;

use Illuminate\Foundation\Http\FormRequest;

class CreateProvinceRequest extends FormRequest
{

    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:32']
        ];
    }
}
