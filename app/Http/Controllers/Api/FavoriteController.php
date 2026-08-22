<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $favorites = Favorite::where('user_id', $request->user()->id)->pluck('car_id');
        return response()->json($favorites);
    }

    public function toggle(Request $request)
    {
        $carId = $request->car_id;

        $existing = Favorite::where('user_id', $request->user()->id)
            ->where('car_id', $carId)
            ->first();

        if ($existing) {
            $existing->delete();
            return response()->json(['favorited' => false]);
        }

        Favorite::create([
            'user_id' => $request->user()->id,
            'car_id' => $carId,
        ]);

        return response()->json(['favorited' => true]);
    }
}