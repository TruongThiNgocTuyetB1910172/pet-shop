<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'original_price' => ['required', 'integer', 'min:0'],
            'selling_price' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ];
    }
}
