<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'product_id',
        'amount',
        'total',
        'quantity',
    ];
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
