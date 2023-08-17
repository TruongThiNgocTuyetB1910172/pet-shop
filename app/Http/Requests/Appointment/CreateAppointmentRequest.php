<?php

namespace App\Http\Requests\Appointment;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class CreateAppointmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:255'],
            'email' => ['required','email'],
            'phone' => ['required', 'regex:/^(0?)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'appointment_at' => ['required', 'after:' . Carbon::now()],
            'status' => ['required', 'in:0,1'],
            'notes' => ['nullable'],
        ];
    }
}
