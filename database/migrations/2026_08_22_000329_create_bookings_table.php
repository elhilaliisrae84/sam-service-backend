<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('car_id');
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('pickup_date');
            $table->string('dropoff_date');
            $table->integer('number_of_days');
            $table->integer('subtotal');
            $table->integer('discount_amount')->default(0);
            $table->integer('total_price');
            $table->string('full_name');
            $table->string('phone');
            $table->string('promo_code')->nullable();
            $table->string('status')->default('confirmée');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};