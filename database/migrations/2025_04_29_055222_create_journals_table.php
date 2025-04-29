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
        Schema::create('journals', function (Blueprint $table) {
            $table->id();
            $table->enum('type_operation',[
                Helper::OPERATIONDEPOSIT,Helper::OPERATIONTRANSFERT,Helper::OPERATIONWITHDRAW_CANCEL,Helper::OPERATIONWITHDRAW,
                Helper::OPERATIONDEPOSIT_CANCEL,Helper::OPERATIONTRANSFERT_CANCEL
            ]);
            $table->decimal('amount', 8, 2)->nullable();
            $table->decimal('balance_before', 8, 2)->nullable();
            $table->decimal('balance_after', 8, 2)->nullable();
            $table->foreignId('customer_id')->nullable()->constrained("customers",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journals');
    }
};
