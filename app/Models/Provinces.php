<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provinces extends Model
{
    protected $table = 'provinces';

    protected $fillable = [
        'name',
    ];
    public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
}
