<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders_ssl', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('name', 255)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('phone', 20)->nullable();
            $table->double('amount')->nullable();
            $table->text('address')->nullable();
            $table->string('status', 10)->nullable();
            $table->string('transaction_id', 255)->nullable();
            $table->string('currency', 20)->nullable();
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders_ssl');
    }
};
