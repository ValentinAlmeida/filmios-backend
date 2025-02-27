<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key');
            $table->timestampsTz();
            $table->softDeletesTz();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropPrimary();
            $table->unique('id', 'profiles_sk');

            $table->primary('key', 'profiles_pk');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
