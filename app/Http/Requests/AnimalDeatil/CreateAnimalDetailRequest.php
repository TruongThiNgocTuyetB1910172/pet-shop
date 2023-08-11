<?php

namespace App\Http\Requests\AnimalDeatil;

use Illuminate\Foundation\Http\FormRequest;

class CreateAnimalDetailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'variant' => ['required'],
            'weight' => ['required',' min:0'],
            'animal_id' => ['required'],
        ];
    }
}
