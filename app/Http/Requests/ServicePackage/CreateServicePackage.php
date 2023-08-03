<?php

namespace App\Http\Requests\ServicePackage;

use Illuminate\Foundation\Http\FormRequest;

class CreateServicePackage extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'max:4096'],
            'description' => ['required'],
            'original_price' => ['nullable', 'min:0'],
            'selling_price' => ['nullable', 'min:0'],
            'service_ids' => ['nullable'],
        ];
    }
}
