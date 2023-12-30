<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('petpreferences', function (Blueprint $table) {
            $table->id('petpreferID');
            $table->string('sterilization')->nullable();
            $table->String('vaccined')->nullable();
            $table->String('dewormed')->nullable();
            $table->String('petcolor')->nullable();
            $table->String('peteyecolor')->nullable();
            $table->String('petage')->nullable();
            $table->String('pettype')->nullable();
            $table->String('petbreed')->nullable();
            $table->String('petsize')->nullable();
            $table->String('petgender')->nullable();
            $table->integer('owner_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petpreferences');
    }
};