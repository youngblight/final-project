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
    Schema::create('messages', function (Blueprint $table) {
        $table->id();
        // Inatunza id ya kazi/ombi husika
        $table->foreignId('job_id')->constrained('job_requests')->onDelete('cascade'); 
        // Nani anatuma (User ID ya mteja au fundi)
        $table->foreignId('sender_id')->constrained('users')->onDelete('cascade');
        // Nani anapokea
        $table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
        // Ujumbe wenyewe
        $table->text('message');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
