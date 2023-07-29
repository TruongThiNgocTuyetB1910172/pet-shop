<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{

    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string','max:255'],
            'category_id'=> ['required'],
            'image' => ['required', 'image', 'max:4096'],
            'product_image.*' => ['nullable', 'image',  'max:4096'],
            'original_price' => ['required'],
            'selling_price' => ['required'],
            'stock' => ['required'],
            'sku' => ['required'],
        ];
    }
}