<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
        return $this->belongsToMany(Service::class, 'service_service_packages', 'service_package_id', 'service_id')
            ->withTimestamps();
    }
    public static function getServicePackageById(string $id): Model|Collection|Builder|array|null
    {
        return ServicePackage::query()->findOrFail($id);
    }

}
