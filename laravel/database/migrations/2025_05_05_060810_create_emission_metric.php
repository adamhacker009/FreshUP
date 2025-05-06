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
        Schema::create('emission_metrics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enterprise_id')->constrained('agricultural_enterprises');
            $table->foreignId('file_id')->nullable()->constrained('satellite_files');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('source', ['satellite', 'manual']);
            $table->string('pollutant_type');
            $table->decimal('value', 10, 2);
            $table->timestamp('measured_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emission_metrics');
    }
};
