<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id',
    ];
    public function province(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Provinces::class);
    }
    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class);
    }
}
