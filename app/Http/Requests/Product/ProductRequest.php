<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function rules(): array|string
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string','max:255'],
            'category_id'=> ['required'],
            'image' => ['required', 'max:4096'],
            'price' => ['required'],
            'original_price' => ['required'],
            'selling_price' => ['required'],
            'stock' => ['required'],
            'sku' => ['required'],
        ];
    }
}
