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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->string('name',244)->nullable(false);
            $table->string('code',244)->nullable(true);
            $table->string('type',244)->nullable(true);
            $table->string('payer_code',244)->nullable(true);
            $table->foreignId('country_id')->nullable()->constrained("countries",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gateways');
    }
};
