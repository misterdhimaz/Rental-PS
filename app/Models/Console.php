<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'price_per_hour',
        'status'
    ];

public function category() {
    return $this->belongsTo(Category::class);
}

public function bookings() {
    return $this->hasMany(Booking::class);
}

}
