<?php

namespace App\Http\Requests\AnimalDeatil;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalDetailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'weight' => ['required', 'min:0'],
            'animal_id' => ['required'],
        ];
    }
}
