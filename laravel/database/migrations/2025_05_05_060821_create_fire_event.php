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
        Schema::create('fire_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enterprise_id')->constrained('agricultural_enterprises');
            $table->foreignId('file_id')->constrained('satellite_files');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->decimal('fire_power', 10, 2);
            $table->timestamp('detected_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fire_events');
    }
};
