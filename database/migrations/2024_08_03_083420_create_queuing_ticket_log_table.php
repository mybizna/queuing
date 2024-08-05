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

            $table->foreignId('ticket_id')->nullable()->index('ticket_id');
            $table->foreignId('attendant_id')->nullable()->index('attendant_id');

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
