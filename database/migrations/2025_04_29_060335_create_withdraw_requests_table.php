<?php

use App\Helpers\Helper;
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
        Schema::create('withdraw_requests', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 14)->default(0);
            $table->float('charge', 14)->default(0);
            $table->string('status')->default(Helper::STATUSPENDING);
            $table->string('sender_note')->nullable();
            $table->string('admin_note')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained("customers",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraw_requests');
    }
};
