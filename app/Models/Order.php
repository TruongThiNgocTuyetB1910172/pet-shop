<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'notes',
        'shipping_address',
        'tracking_number',
        'admin_id',
        'payment_type',
        'payment_status',
        'order_shipper_status',
        'shipper_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function admin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function shipper(): BelongsTo
    {
        return $this->belongsTo(Shipper::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }

    public static function getOrderById(string $id): Model|Collection|Builder|array|null
    {
        return Order::query()->findOrFail($id);
    }

    public function productReviews(): HasMany
    {
        return $this->hasMany(ProductReview::class);
    }

    public function feedback(): BelongsTo
    {
        return $this->belongsTo(Feedback::class);
    }

    public static function getAllMonthlyRevenue()
    {
        return static::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total) as revenue')
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->where('status', 'success')
            ->get();
    }
    //doanh thu hang thang


    public static function getMonthlyRevenue()
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        return static::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->where('status', 'success')
            ->sum('total');
    }

    // doanh thu thanh hien tai

}
