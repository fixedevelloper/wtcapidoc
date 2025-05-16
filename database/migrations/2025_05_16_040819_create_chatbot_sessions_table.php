<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chatbot_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('user_number');
            $table->string('step')->default('start');
            $table->string('sender')->nullable();
            $table->string('beneficiary')->nullable();
            $table->string('country_code')->nullable();
            $table->string('gateway')->nullable();
            $table->boolean('is_delete')->default(false);
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('service')->nullable(); // balance | transfer | recharge
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chatbot_sessions');
    }
};
