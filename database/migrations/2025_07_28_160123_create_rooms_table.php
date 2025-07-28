<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');                  // Room title/name (e.g. "Single Room")
            $table->string('image');                 // Image filename or path
            $table->decimal('price', 8, 2);          // Price (e.g. 110.00)
            $table->text('description');             // Room description
            $table->timestamps();                    // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
}
