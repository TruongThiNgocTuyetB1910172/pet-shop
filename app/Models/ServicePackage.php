<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicePackage extends Model
{
    protected $table = 'service_packages';

    protected $fillable = [
        'name',
        'description',
        'original_price',
        'selling_price',
        'image',
    ];
    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class,'service_service_package','servicePackage_id','service_id');
    }
}
