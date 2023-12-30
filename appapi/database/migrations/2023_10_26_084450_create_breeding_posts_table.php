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
        Schema::create('breeding_posts', function (Blueprint $table) {
            $table->id('breedpostID');
            // $table->string('breed_desc')->nullable();
            // $table->String('breed_date')->nullable();
            $table->String('breed_status')->nullable();
            $table->integer('owner_id')->nullable();
            $table->timestamps();
          //  $table->integer('requester_id');
            $table->integer('pet_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('breeding_posts');
    }
};
