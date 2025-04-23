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
        Schema::create('senders', function (Blueprint $table) {
            $table->id();
            $table->string('code',244)->nullable(false);
            $table->string('first_name',244)->nullable(false);
            $table->string('last_name',244)->nullable(false);
            $table->date('date_birth')->nullable(false);
            $table->string('num_document',244)->nullable(false);
            $table->string('country',244)->nullable(false);
            $table->string('address',244)->nullable(false);
            $table->string('city',244)->nullable(false);
            $table->string('phone',244)->nullable(false);
            $table->string('identification_document',244)->nullable(false);
            $table->string('expired_document',244)->nullable(false);
            $table->string('occupation',244)->nullable(false);
            $table->string('civility',244)->nullable(false);
            $table->string('gender',244)->nullable(false);
            $table->string('email',244)->unique(true);
            $table->foreignId('customer_id')->nullable()->constrained("customers",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('senders');
    }
};
