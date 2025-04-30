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
        Schema::table('journals', function (Blueprint $table) {
            $table->decimal('amount', 15, 2)->change();
            $table->decimal('balance_before', 15, 2)->change();
            $table->decimal('balance_after', 15, 2)->change();
        });
        Schema::table('deposit_requests', function (Blueprint $table) {
            $table->string('proof_image',244)->nullable(true);
            $table->string('type')->nullable();
            $table->string('phone')->nullable();
            $table->string('reference')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journals', function (Blueprint $table) {
            //
        });
    }
};
