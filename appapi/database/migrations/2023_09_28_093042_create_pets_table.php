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
        Schema::create('pets', function (Blueprint $table) {
            $table->id('petID');
            $table->string('petimage')->nullable();
            $table->String('petname')->nullable();
            $table->String('pettype')->nullable();
            $table->String('petbreed')->nullable();
            $table->String('petbirthdate')->nullable();
            $table->String('petgender')->nullable();
            $table->String('petsize')->nullable();
            $table->String('petsterilized')->nullable();
            $table->String('petvaccinated')->nullable();
            $table->String('petdewormed')->nullable();
            $table->string('pet_eye_color')->nullable();
            $table->String('pet_color')->nullable();
            $table->String('petage')->nullable();
            $table->String('petstatus')->nullable();
            $table->timestamps();
            $table->integer('owner_id');
            $table->integer('old_owner_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pets');
    }
};