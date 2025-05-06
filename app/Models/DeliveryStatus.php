<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DeliveryStatus extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'statusName',
    ];

    public function deliveryStatusToOrderDetail(): HasMany {
        return $this->hasMany(OrderDetail::class, 'deliveryStatus_id');
    }
}
