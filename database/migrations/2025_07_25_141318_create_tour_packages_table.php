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
        Schema::create('tour_packages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('class'); // 'mountain', 'sea', 'normal'
            $table->string('image');
            $table->string('features');
            $table->text('description');
            $table->unsignedInteger('duration_day')->default(0);   // Add this line
            $table->unsignedInteger('duration_night')->default(0); // Add this line
            $table->decimal('price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_packages');
    }
};
