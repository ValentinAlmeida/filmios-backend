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
        Schema::create('profile_feature', function (Blueprint $table) {
            $table->id();
            $table->string('profile_key');
            $table->string('feature_key');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('profile_key')->references('key')->on('profiles')->onDelete('cascade');
            $table->foreign('feature_key')->references('key')->on('features')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_feature');
    }
};
