<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiLogsTable extends Migration
{
    public function up()
    {
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string('method');
            $table->string('url');
            $table->string('ip');
            $table->json('headers')->nullable();
            $table->json('request_body')->nullable();
            $table->integer('response_status')->nullable();
            $table->json('response_body')->nullable();
            $table->decimal('duration_ms', 8, 2)->nullable();
            $table->foreignId('customer_id')->nullable()->constrained("customers",'id')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('api_logs');
    }
}
