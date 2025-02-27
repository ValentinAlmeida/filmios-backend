<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('cpf', 14)->unique()->index();
            $table->string('email')->unique();
            $table->string('name');
            $table->string('telephone');
            $table->string('login')->unique();
            $table->string('password');
            $table->string('profile_key')->nullable();
            $table->foreign('profile_key')->nullable()->references('key')->on('profiles')->onDelete('set null');
            $table->boolean('active')->default(true);
            $table->boolean('block')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
