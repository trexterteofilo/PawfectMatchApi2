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
        Schema::create('adoptions', function (Blueprint $table) {
            $table->id('adoptID');
            $table->string('adopt_desc')->nullable();
            $table->String('adopt_date')->nullable();
            $table->String('adopt_payment')->nullable();
            $table->String('adopt_status')->nullable();
            $table->String('adopter')->nullable();
            $table->String('old_owner_id')->nullable();
            $table->timestamps();
            $table->String('monthsowned');
            $table->integer('owner_id');
            $table->integer('pet_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adoptions');
    }
};