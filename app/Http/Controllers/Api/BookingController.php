<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $bookings = Booking::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($bookings);
    }

 public function store(Request $request)
    {
        $booking = Booking::create([
            'user_id' => $request->user()->id,
            'car_id' => $request->car_id,
            'car_brand' => $request->car_brand,
            'car_model' => $request->car_model,
            'pickup_date' => $request->pickup_date,
            'dropoff_date' => $request->dropoff_date,
            'number_of_days' => $request->number_of_days,
            'subtotal' => $request->subtotal,
            'discount_amount' => $request->discount_amount ?? 0,
            'total_price' => $request->total_price,
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'promo_code' => $request->promo_code,
        ]);

        // Ajout automatique des points de fidélité (1 point par euro dépensé)
        $user = $request->user();
        $user->loyalty_points += $request->total_price;
        $user->save();

        return response()->json($booking, 201);
    }
}