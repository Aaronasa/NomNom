<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'orderDate',
        'totalPrice',
        'paymentStatus',
        'user_id'
    ];

    protected $casts = [
        'orderDate' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orderDetailInOrder(): HasMany {
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }
}
