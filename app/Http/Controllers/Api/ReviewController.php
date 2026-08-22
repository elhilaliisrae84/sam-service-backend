<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index($carId)
    {
        $reviews = Review::with('user:id,name')
            ->where('car_id', $carId)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($review) {
                return [
                    'id' => $review->id,
                    'rating' => $review->rating,
                    'comment' => $review->comment,
                    'userName' => $review->user->name,
                    'createdAt' => $review->created_at,
                ];
            });

        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $review = Review::create([
            'user_id' => $request->user()->id,
            'car_id' => $request->car_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return response()->json($review, 201);
    }
}