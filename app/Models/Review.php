<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'rating',           // Integer (1-5, misalnya)
        'comment',          // Textual review
        'user_id',          // Reviewer
        'order_detail_id'   // Menu yang direview melalui detail order
    ];

    /**
     * Relasi ke User (pemberi review)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}
