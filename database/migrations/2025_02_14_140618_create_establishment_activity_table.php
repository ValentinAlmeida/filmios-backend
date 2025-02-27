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
        Schema::create('establishment_activity', function (Blueprint $table) {
            $table->id();
            $table->foreignId('establishment_id')->constrained('establishment')->onDelete('set null');
            $table->foreignId('activity_id')->constrained('activity')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishment_activity');
    }
};
