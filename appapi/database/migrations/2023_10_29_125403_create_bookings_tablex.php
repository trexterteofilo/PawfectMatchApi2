<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('bookID');
            $table->string('booking_date')->nullable();
            $table->string('booking_day')->nullable();
            $table->String('booking_time')->nullable();
            $table->String('booking_payment')->nullable();
            $table->String('booking_status')->nullable();
            $table->String('requester_id')->nullable();
            $table->String('petshooter_id')->nullable();
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

