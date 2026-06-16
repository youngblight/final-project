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
        Schema::table('craftsmen', function (Blueprint $table) {
            // Add service_id to establish a foreign key relationship with the services table
            $table->foreignId('service_id')
                ->nullable()
                ->constrained('services')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('craftsmen', function (Blueprint $table) {
            // Drop foreign key constraint first, then drop the column safely
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};