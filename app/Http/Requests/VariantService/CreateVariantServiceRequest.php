<?php

namespace App\Http\Requests\VariantService;

use Illuminate\Foundation\Http\FormRequest;

class CreateVariantServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'service_id' => ['required'],
            'animal_detail_id' => ['required'],
            'price' => ['required'],

        ];
    }
}
