<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Shipper extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $guard = 'shipper';

    protected $table = 'shippers';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'gender',
        'email_verified_at',
        'status',
        'image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public static function getShipperById(string $id): Model|Collection|Builder|array|null
    {
        return Shipper::query()->findOrFail($id);

    }

}
