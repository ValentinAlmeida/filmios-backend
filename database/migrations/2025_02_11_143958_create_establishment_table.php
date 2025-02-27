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
        Schema::create('establishment', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_mei');
            $table->string('company_name');
            $table->string('trade_name');
            $table->string('key_document');
            $table->string('key_status');
            $table->string('document');
            $table->string('cga');
            $table->string('telephone');
            $table->string('email');
            $table->string('identification_document_path')->nullable();
            $table->string('operating_license_path')->nullable();
            $table->string('social_contract_path')->nullable();
            $table->string('mei_path')->nullable();
            $table->foreignId('unit_address_id')->nullable()->constrained('unit_address')->onDelete('set null');
            $table->foreignId('legal_guardian_id')->nullable()->constrained('legal_guardian')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('establishment');
    }
};
