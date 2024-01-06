<?php

use Carbon\Carbon;
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
        Schema::create('habit_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('habit_id');
            $table->boolean('is_confirmed')->default(false);
            $table->timestamps();

            $table->foreign('habit_id')->references('id')->on('habits')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habit_log');
    }
};
