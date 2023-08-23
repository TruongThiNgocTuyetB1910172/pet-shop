<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'name',
        'phone',
        'email',
        'appointment_at',
        'notes',
    ];
    public static function getAppointmentById(string $id): Model|Collection|Builder|array|null
    {
        return Appointment::query()->findOrFail($id);
    }
}
