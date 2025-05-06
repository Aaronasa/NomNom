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
        'user_id',
    ];

    public function restaurantToFood(): HasMany {
        return $this->hasMany(Food::class, 'restaurant_id');
    }
    public function owner(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($restaurant) {
            if (isset($restaurant->user_id)) {
                $user = User::find($restaurant->user_id);
                if (!$user || $user->role_id !== 3) {
                    throw new \Exception('Restaurant harus dimiliki oleh user dengan role restaurant owner (role_id = 3)');
                }
            }
        });

        static::updating(function ($restaurant) {
            if ($restaurant->isDirty('user_id') && $restaurant->user_id) {
                $user = User::find($restaurant->user_id);
                if (!$user || $user->role_id !== 3) {
                    throw new \Exception('Restaurant harus dimiliki oleh user dengan role restaurant owner (role_id = 3)');
                }
            }
        });

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
