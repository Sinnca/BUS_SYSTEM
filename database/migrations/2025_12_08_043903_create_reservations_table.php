<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->foreignId('return_trip_id')->nullable()->constrained('trips')->onDelete('set null');
            $table->string('reservation_code')->unique();
            $table->integer('adults');
            $table->integer('children')->default(0);
            $table->decimal('total_price', 8, 2);
            $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
            $table->json('passenger_names'); // ["John Doe", "Jane Doe"]
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
