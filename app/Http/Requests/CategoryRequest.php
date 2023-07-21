<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:32']
        ];
    }
}
