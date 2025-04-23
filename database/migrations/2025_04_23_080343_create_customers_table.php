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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('wtc_private_key',244)->nullable(true);
            $table->string('wtc_secret_key',244)->nullable(true);
            $table->string('wtc_sandbox_private_key',244)->nullable(false);
            $table->string('wtc_sandbox_secret_key',244)->nullable(false);
            $table->string('phone',244)->nullable(false);
            $table->string('address',244)->nullable(true);
            $table->string('country',244)->nullable(true);
            $table->boolean('activated')->default(false);
            $table->float('balance',2)->default(0.0);
            $table->float('balance_sandbox',2)->default(5000.0);
            $table->foreignId('user_id')->nullable()->constrained("users",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
