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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('console_id')->constrained()->onDelete('cascade');
        $table->string('booking_code')->unique(); // PASTIKAN BARIS INI ADA
        $table->integer('duration');              // Pastikan ini juga ada
        $table->decimal('total_price', 12, 2);
        $table->enum('status', ['pending', 'confirmed', 'finished', 'cancelled'])->default('pending');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
