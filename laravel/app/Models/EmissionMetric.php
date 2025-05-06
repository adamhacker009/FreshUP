<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class EmissionMetric extends Model
{
    use HasFactory;

    protected $fillable = [
        'enterprise_id',
        'file_id',
        'user_id',
        'source',
        'pollutant_type',
        'value',
        'measured_at'
    ];

    protected $casts = [
        'measured_at' => 'datetime'
    ];

    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(AgriculturalEnterprise::class);
    }

    public function file(): BelongsTo
    {
        return $this->belongsTo(SatelliteFile::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
