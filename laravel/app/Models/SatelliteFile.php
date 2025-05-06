<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatelliteFile extends Model
{
    use HasFactory;
    protected $fillable = [
        'source_id',
        'file_path',
        'status',
        'metadata',
        'processed_at'
    ];

    protected $casts = [
        'metadata' => 'array',
        'processed_at' => 'datetime'
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(SatelliteSource::class);
    }

    public function emissionMetrics(): HasMany
    {
        return $this->hasMany(EmissionMetric::class);
    }

    public function fireEvents(): HasMany
    {
        return $this->hasMany(FireEvent::class);
    }
}
