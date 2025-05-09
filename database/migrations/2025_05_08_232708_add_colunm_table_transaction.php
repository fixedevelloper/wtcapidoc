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
        Schema::table('transactions', function (Blueprint $table) {
            $table->string('rounting_number',244)->nullable();
            $table->string('branch_number',244)->nullable();
            $table->string('ifsc_code',244)->nullable();
            $table->string('callback_url',244)->nullable();
            $table->boolean('is_notifiable')->default(false);
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
