<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receipt extends Model
{
    protected $table = 'receipts';

    protected $fillable = [
        'total',
        'admin_id',
        'status',
        'notes',
        'tracking_number',
    ];

    public function receiptDetails(): HasMany
    {
        return $this->hasMany(ReceiptDetail::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class);
    }

    public static function getReceiptById(string $id): Model|Collection|Builder|array|null
    {
        return Receipt::query()->findOrFail($id);
    }

}
