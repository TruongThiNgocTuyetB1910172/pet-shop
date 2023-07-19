<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    protected $fillable = [
        'house_number',
        'user_id',
        'address',
        'ward_id',
        'district_id',
        'province_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
