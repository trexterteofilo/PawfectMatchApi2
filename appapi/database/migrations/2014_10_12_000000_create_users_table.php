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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('address')->nullable();
            $table->string('bio')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('email')->unique();
            $table->string('image')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('accounttype');
            $table->rememberToken();
            $table->timestamps();
            $table->integer('role');
            $table->string('accountstatus')->nullable();
            $table->string('device_id')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
