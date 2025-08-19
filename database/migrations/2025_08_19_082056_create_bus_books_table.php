<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('busbook', function (Blueprint $table) {
            $table->id();
            $table->string('start_location');
            $table->string('end_location');
            $table->date('journey_date');
            $table->time('journey_time')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('seat_number'); // Example: A1, B2, H5 etc.
            $table->enum('status', ['booked', 'cancelled'])->default('booked');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_books');
    }
};
