<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurantName',
        'restaurantAddress',
        'restaurantPhone',
    ];

    public function restaurantToFood(): HasMany {
        return $this->hasMany(Food::class, 'restaurant_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($restaurant) {
            // Delete all related Foods
            $restaurant->restaurantToFood->each(function ($food) {
                // Delete related MenuDays for each Food
                $food->foodToMenuDay()->delete();
                $food->delete();
            });
        });
    }
}
