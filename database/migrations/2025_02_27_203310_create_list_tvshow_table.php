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
        Schema::create('list_tvshow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->on('list')->onDelete('set null');
            $table->boolean('adult')->nullable();
            $table->boolean('assisted')->nullable();
            $table->boolean('favorited')->nullable();
            $table->string('backdrop_path')->nullable();
            $table->string('original_language')->nullable();
            $table->string('overview')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('name')->nullable();
            $table->integer('popularity')->nullable();
            $table->integer('vote_average')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_tvshow');
    }
};
