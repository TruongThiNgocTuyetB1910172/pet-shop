<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required'],
            'category_id' => ['required'],
            'image' => ['required', 'image', 'max:4096'],
            'product_image.*' => ['nullable', 'image',  'max:4096'],
            'selling_price' => ['required','integer','min:0'],
            'sku' => ['required'],
            'feature' => ['required','in:0,1'],
        ];
    }
}
