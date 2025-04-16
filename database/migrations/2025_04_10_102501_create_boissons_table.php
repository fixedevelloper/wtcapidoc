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
        Schema::create('boissons', function (Blueprint $table) {
            $table->id();
            $table->string('name',244)->nullable(false);
            $table->string('price',244)->nullable(false);
            $table->integer('quantity')->default(0);
            $table->date('date')->nullable(false);
            $table->foreignId('type_boisson_id')->nullable()->constrained("type_boissons",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('boissons');
    }
};
