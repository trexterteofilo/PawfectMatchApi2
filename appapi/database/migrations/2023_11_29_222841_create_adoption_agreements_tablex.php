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
        Schema::create('adoption_agreements', function (Blueprint $table) {
            $table->id('adoptagreementID');
            $table->String('adoptreq_id')->nullable();
            $table->String('owner_id')->nullable();
            $table->String('pet_id')->nullable();
            $table->String('requester_id')->nullable();
            $table->String('pickup_location')->nullable();
            $table->String('pickup_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoption_agreements');
    }
};
