<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'car_brand',
        'car_model',
        'pickup_date',
        'dropoff_date',
        'number_of_days',
        'subtotal',
        'discount_amount',
        'total_price',
        'full_name',
        'phone',
        'promo_code',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}