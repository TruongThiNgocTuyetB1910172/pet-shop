<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        /** @var User $user */
        $user = $this->route('user.update');

        return [
            'name' => ['required','string', 'max:255'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'is_admin' => ['required', 'in:0,1'],
            'status' => ['required', 'in:0,1'],
        ];
    }
}