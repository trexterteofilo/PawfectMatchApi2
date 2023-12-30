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
                Schema::create('petcredential_types', function (Blueprint $table) {
                        $table->id();
                        $table->integer('owner_id');
                        $table->integer('pet_id');
                        $table->String('cred_type');
                        $table->timestamps();
                });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
                Schema::dropIfExists('petcredential_types');
        }
};
