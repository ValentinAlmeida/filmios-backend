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
        Schema::create('features', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::table('features', function (Blueprint $table) {
            $table->dropPrimary();
            $table->unique('id', 'features_sk');

            $table->primary('key', 'features_pk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('features');
    }
};
