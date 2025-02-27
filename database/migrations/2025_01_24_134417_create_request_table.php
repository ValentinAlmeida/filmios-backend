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
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_approver_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('user_creator_id')->constrained('users');
            $table->string('profile_key');
            $table->string('status_establishment_key');
            $table->string('observation')->nullable();
            $table->timestamp('term')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
