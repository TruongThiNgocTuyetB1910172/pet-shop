<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected  $fillable = [
        'name',
        'category_id',
        'description',
        'sku',
        'stock',
        'original_price',
        'selling_price',
    ];
    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

}
