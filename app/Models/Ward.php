<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ward extends Model
{
    protected $table = 'wards';

    protected $fillable = [
        'name',
        'district_id',
    ];

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public static function getWardById(string $id): Model|Collection|Builder|array|null
    {
        return Ward::query()->findOrFail($id);
    }
}
