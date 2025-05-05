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
        Schema::table('senders', function (Blueprint $table) {
            $table->decimal('max_transaction',15,2)->default(1000000);
        });
        Schema::table('customers', function (Blueprint $table) {
            $table->string('image',244)->nullable();
            $table->string('gender')->nullable();
            $table->string('occupation')->nullable();
            $table->string('identification_type')->nullable();
            $table->string('identification_number')->nullable();
            $table->string('identification_image_face')->nullable();
            $table->string('identification_image_recto')->nullable();
            $table->string('is_kyc_verified')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
