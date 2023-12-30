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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id('notificationID');
            $table->string('type')->nullable;
            $table->string('title')->nullable;
            $table->string('body')->nullable;
            $table->string('recipient_id')->nullable;
            $table->string('sender_id')->nullable;
            $table->string('notification_status')->nullable;
            $table->string('route')->nullable;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
