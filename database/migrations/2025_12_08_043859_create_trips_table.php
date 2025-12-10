<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained()->onDelete('cascade');
            $table->string('origin');
            $table->string('destination');
            $table->date('departure_date');
            $table->time('departure_time'); // 08:00, 12:00, or 16:00
            $table->integer('available_seats');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            // Index for faster searches
            $table->index(['origin', 'destination', 'departure_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
