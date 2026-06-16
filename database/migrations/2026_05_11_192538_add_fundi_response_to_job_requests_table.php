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
      Schema::table('job_requests', function (Blueprint $table) {
       $table->text('fundi_response')->nullable(); // Hapa ndipo gharama na ujumbe vitakaa
    });
   }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_requests', function (Blueprint $table) {
            //
        });
    }
};
