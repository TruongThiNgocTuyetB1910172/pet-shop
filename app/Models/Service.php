<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'original_price',
        'selling_price',
        'image',
    ];
    public $timestamps = true;
    public function servicePacks(): BelongsToMany
    {
        return $this->belongsToMany(ServicePackage::class,'service_service_package','service_id','servicePackage_id');
    }
}
