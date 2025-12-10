<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reserved_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('trip_id')->constrained()->onDelete('cascade');
            $table->integer('seat_number');
            $table->foreignId('reservation_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            // Prevent double booking of same seat on same trip
            $table->unique(['trip_id', 'seat_number']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reserved_seats');
    }
};
