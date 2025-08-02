<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cottage_id',
        'full_name',
        'guests',
        'address',
        'contact_number',
        'email',
        'reserve_date',
        'gcash_receipt',
        'status',
        'notes',
    ];

    // 🔁 Relationship to Cottage
    public function cottage()
    {
        return $this->belongsTo(Cottage::class);
    }

    // 🔁 Relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ Automatically assign user_id when creating reservation
    protected static function booted()
    {
        static::creating(function ($reservation) {
            if (auth()->check()) {
                $reservation->user_id = auth()->id();
            }
        });
    }
}
