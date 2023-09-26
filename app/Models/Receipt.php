<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'total',
        'status',
        'notes',
        'tracking_number',
    ];

    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }

}
