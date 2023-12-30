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
        Schema::create('adoptionrequests', function (Blueprint $table) {
            $table->id('adoptreqID');
            $table->timestamps();
            $table->integer('owner_id');
            $table->integer('adoption_id')->nullable();
            $table->integer('requester_id')->nullable();
            $table->integer('pet_id')->nullable();
            $table->String('adoption_req_status')->nullable();
            $table->String('pickup_date')->nullable();
            $table->String('pickup_location')->nullable();
            
            $table->String('cancelled_by')->nullable();
            $table->integer('old_owner_id')->nullable();

            // $table->foreign('owner_id')->references('userID')->on('users')->onDelete('cascade');
            // $table->foreign('requester_id')->references('userID')->on('users')->onDelete('cascade');
            // $table->foreign('pet_id')->references('petID')->on('pets')->onDelete('cascade');
            // $table->foreign('old_owner_id')->references('userID')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptionrequests');
    }
};