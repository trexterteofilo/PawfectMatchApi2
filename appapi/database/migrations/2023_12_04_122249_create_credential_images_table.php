<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
        /**
         * Run the migrations.
         */
        public function up()
        {
                Schema::create('petcredential_images', function (Blueprint $table) {
                        $table->id();
                        $table->integer('owner_id');
                        $table->integer('pet_id');
                        $table->String('image_path');
                        $table->timestamps();

                        // Add columns for up to 6 images
                        // for ($i = 1; $i <= 6; $i++) {
                        //     $table->string('image_path_' . $i)->nullable();
                        // }

                });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
                Schema::dropIfExists('petcredential_images');
        }
};