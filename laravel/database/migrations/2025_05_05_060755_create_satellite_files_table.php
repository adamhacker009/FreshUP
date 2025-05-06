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
        Schema::create('satellite_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('source_id')->constrained('satellite_sources');
            $table->string('file_path');
            $table->enum('status', ['pending', 'processed', 'failed'])->default('pending');
            $table->json('metadata')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('satellite_files');
    }
};
