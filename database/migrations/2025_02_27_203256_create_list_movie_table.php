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
        Schema::create('list_movie', function (Blueprint $table) {
            $table->id();
            $table->string('backdrop_path')->nullable();
            $table->string('title')->nullable();
            $table->string('overview')->nullable();
            $table->string('poster_path')->nullable();
            $table->string('media_type')->nullable();
            $table->integer('popularity')->nullable();
            $table->string('release_date')->nullable();
            $table->integer('vote_average')->nullable();
            $table->boolean('adult')->nullable();
            $table->boolean('assisted')->nullable();
            $table->boolean('favorited')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_movie');
    }
};
