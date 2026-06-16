<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
       public function up()
{
    Schema::create('payments', function (Blueprint $table) {
        $table->id();
        // Inaunganishwa na Job Request ili tujue malipo ni ya kazi gani 
        $table->foreignId('job_request_id')->constrained()->onDelete('cascade');
        
        $table->decimal('amount', 10, 2); // Kiasi cha malipo
        $table->string('payment_method'); // M-Pesa, Tigo Pesa, n.k. [cite: 142]
        $table->string('transaction_id')->unique(); // ID kutoka kwa mtoa huduma
        
        // Hali ya malipo (Status) ili kuzuia upotevu wa mapato [cite: 158]
        $table->enum('status', ['pending', 'completed', 'failed'])->default('pending');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
