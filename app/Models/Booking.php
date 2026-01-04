<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'user_id',
        'console_id',
        'booking_code',
        'duration',
        'total_price',
        'status',
    ];

    // Relasi ke User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Console
    public function console() {
        return $this->belongsTo(Console::class);
    }
}
