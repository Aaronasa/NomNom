<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Food extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'foodName',
        'foodDescription',
        'foodPrice',
        'foodImage',
        'restaurant_id'
    ];

    public function foodToMenuDay(): HasMany {
        return $this->hasMany(MenuDay::class, 'food_id');
    }

    public function restaurantInFood(): BelongsTo{
        return $this->belongsTo(Restaurant::class, 'restaurant_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($food) {
            // Delete all related Foods
            $food->foodToMenuDay->each(function ($menuday) {
                // Delete related MenuDays for each Food
                $menuday->delete();
            });
        });
    }
}