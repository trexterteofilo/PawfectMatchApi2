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
        Schema::create('petshooters', function (Blueprint $table) {
            $table->id('petshooterID');
            $table->unsignedBigInteger('petshooter_id')->unique();
            $table->string('contact_number')->nullable();
            $table->longText('experience')->nullable();
            $table->longText('petshooterprice')->nullable();
            //referes that petshooter id is refering to id on users table
            $table->foreign('petshooter_id')->references('userID')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petshooters');
    }
};
