<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('package_id');
            $table->string('title');
            $table->decimal('price', 8, 2);
            $table->integer('person_count');
            $table->string('extra_package')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->timestamps();

            $table->foreign('package_id')->references('id')->on('tour_packages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
