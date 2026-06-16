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
Schema::create('craftsmen', function (Blueprint $table) { // Tumia Blueprint badala ya Table
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->string('full_name'); 
    $table->string('phone')->unique(); 
    $table->string('skill_category');
    $table->string('location_name'); 
    $table->string('verification_doc')->nullable();
    $table->enum('status', ['pending', 'verified', 'approved'])->default('pending');
    $table->decimal('latitude', 10, 8)->nullable();
    $table->decimal('longitude', 11, 8)->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('craftsmen');
    }
};
