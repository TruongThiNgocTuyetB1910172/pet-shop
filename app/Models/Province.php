<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name',
    ];

    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
    public static function getProvinceById(string $id): Model|Collection|Builder|array|null
    {
        return Province::query()->findOrFail($id);
    }
}
