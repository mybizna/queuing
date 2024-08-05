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
        Schema::create('queuing_ticket', function (Blueprint $table) {
            $table->id();

            $table->string('number')->nullable();
            $table->string('prefix')->nullable();
            $table->foreignId('attendant_id')->nullable()->index('attendant_id');
            $table->tinyInteger('is_announced')->nullable()->default(0);
            $table->tinyInteger('is_closed')->nullable()->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('queuing_ticket');
    }
};
