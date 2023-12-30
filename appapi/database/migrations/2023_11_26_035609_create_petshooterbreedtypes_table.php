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
        Schema::create('petshooter_breedtypes', function (Blueprint $table) {
            $table->id('breedtypeID');
            $table->integer('petshooter_id');
            $table->String('breedtype')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petshooter_breedtypes');
    }
};
