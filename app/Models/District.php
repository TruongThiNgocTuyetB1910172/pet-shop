<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'name',
        'province_id',
    ];

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }
    public function wards(): HasMany
    {
        return $this->hasMany(Ward::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public static function getDistrictById(string $id): Model|Collection|Builder|array|null
    {
        return District::query()->findOrFail($id);
    }
}
