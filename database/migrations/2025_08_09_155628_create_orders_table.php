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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Foreign keys (not nullable, must provide package_id and user_id)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained('tour_packages')->onDelete('cascade');

            // Order info (nullable with default)
            $table->string('name')->nullable()->default('Unnamed Order');
            $table->string('email')->nullable()->default('noemail@example.com');
            $table->string('phone')->nullable()->default('N/A');
            $table->string('address')->nullable();

            // Amount & payment info
            $table->decimal('amount', 10, 2)->nullable()->default(0.00);
            $table->string('currency')->default('BDT');
            $table->string('transaction_id')->nullable()->unique();

            // Order status
            $table->enum('status', ['Pending', 'Paid', 'Failed', 'Cancelled'])->default('Pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
