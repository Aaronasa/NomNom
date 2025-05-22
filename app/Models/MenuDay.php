<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MenuDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'foodDate',
        'food_id'
    ];

    public function foodInMenuDay()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    public function menuDayToOrderDetail(): HasMany
    {
        return $this->hasMany(OrderDetail::class, 'menuDay_id');
    }
}
