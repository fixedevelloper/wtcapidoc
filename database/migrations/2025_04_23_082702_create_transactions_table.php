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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code',244)->nullable(false);
            $table->string('mode',244)->nullable(false)->comment('bank or mobile');
            $table->string('number_transaction',244)->nullable(false);
            $table->float('amount',2)->nullable(false);
            $table->float('amount_total',2)->nullable(false);
            $table->float('rate',2)->nullable(false);
            $table->string('status',244)->nullable(false);
            $table->string('relation',244)->nullable(false);
            $table->string('origin_fond',244)->nullable(false);
            $table->string('motif_send',244)->nullable(false);
            $table->string('accountNumber',244)->nullable(true);
            $table->string('gateway',244)->nullable(true);
            $table->string('operator',244)->nullable(true);
            $table->string('city',2)->nullable(true);
            $table->string('iban',244)->nullable(true);
            $table->string('swift',244)->nullable(true);
            $table->foreignId('customer_id')->nullable()->constrained("customers",'id')->nullOnDelete();
            $table->foreignId('sender_id')->nullable()->constrained("senders",'id')->nullOnDelete();
            $table->foreignId('beneficiary_id')->nullable()->constrained("beneficiaries",'id')->nullOnDelete();
            $table->foreignId('gateway_id')->nullable()->constrained("gateways",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
