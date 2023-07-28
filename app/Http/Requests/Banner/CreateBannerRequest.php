<?php

namespace App\Http\Requests\Banner;

use Illuminate\Foundation\Http\FormRequest;

class CreateBannerRequest extends FormRequest
{

    public function rules(): array|string
    {
        return [
            'status' => ['required'],
            'image' => ['required', 'image', 'max:4096'],
        ];
    }
}
