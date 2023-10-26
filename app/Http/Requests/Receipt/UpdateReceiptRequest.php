<?php

namespace App\Http\Requests\Receipt;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReceiptRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'quantity' => ['nullable'],
            'price' => ['nullable'],
            'notes' => ['nullable'],
            'status' => ['required'],
        ];
    }
}
