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
        Schema::create('agreements', function (Blueprint $table) {
            $table->id('agreementID');
            $table->String('agreement_date')->nullable();
            $table->String('recipient_id')->nullable();
            $table->String('requester_id')->nullable();
            $table->String('pettype')->nullable();
            $table->String('requester_pet_id')->nullable();
            $table->String('recipient_pet_id')->nullable();
            $table->String('agreement_location')->nullable();
            $table->String('agreement_payperson')->nullable();
            $table->String('agreement_shooter')->nullable();
            $table->String('first_session')->nullable();
            $table->String('second_session')->nullable();
            $table->String('third_session')->nullable();
            $table->String('agreement_payment')->nullable();
            $table->String('agreement_paymode')->nullable();
            $table->String('agreement_info')->nullable();
            $table->String('agreement_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agreements');
    }
};
