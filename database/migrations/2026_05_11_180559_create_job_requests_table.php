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
  Schema::create('job_requests', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained();
    $table->foreignId('craftsman_id')->constrained('craftsmen');
    $table->string('customer_name')->nullable();
    $table->string('customer_phone')->nullable();
    $table->text('job_description');
    $table->string('status')->default('pending');
    $table->decimal('agreed_price', 15, 2)->nullable();
    $table->integer('rating')->nullable();
    $table->text('comment')->nullable();
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_requests');
    }
};
