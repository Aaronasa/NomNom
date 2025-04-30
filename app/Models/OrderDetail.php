<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderDetail extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'price',
        'unit',
        'deliveryStatus_id',
        'menuDay_id',
        'order_id'
    ];

    public function deliveryStatusInOrderDetail(): BelongsTo{
        return $this->belongsTo(DeliveryStatus::class, 'deliveryStatus_id');
    }

    public function menuDayInOrderDetail(): BelongsTo{
        return $this->belongsTo(MenuDay::class, 'menuDay_id');
    }

    public function orderInOrderDetail(): BelongsTo{
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
