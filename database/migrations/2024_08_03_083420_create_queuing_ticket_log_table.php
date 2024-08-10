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
        Schema::create('queuing_ticket_log', function (Blueprint $table) {
            $table->id();

            $table->foreignId('ticket_id')->constrained('queuing_ticket')->onDelete('cascade')->nullable()->index('queuing_ticket_log_ticket_id');
            $table->foreignId('attendant_id')->constrained('queuing_attendant')->onDelete('cascade')->nullable()->index('queuing_ticket_log_attendant_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queuing_ticket_log');
    }
};
