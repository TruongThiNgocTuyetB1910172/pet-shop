<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'sku',
        'stock',
        'original_price',
        'selling_price',
        'image',
        'category_id',
        'feature',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'product_id');
    }
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class, 'product_id');
    }

    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }
    public static function getProductById(string $id): Model|Collection|Builder|array|null
    {
        return Product::query()->findOrFail($id);
    }
}
