<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'image',
        'status',
    ];
    public static function getBannerById(string $id): Model|Collection|Builder|array|null
    {
        return Banner::query()->findOrFail($id);
    }
}
