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
        Schema::create('unit_address', function (Blueprint $table) {
            $table->id();
            $table->string('cep');
            $table->string('type_of_street');
            $table->string('street');
            $table->string('complement');
            $table->string('neighborhood');
            $table->string('municipality');
            $table->string('reference_point')->nullable();
            $table->integer('number');
            $table->boolean('with_number')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_address');
    }
};
