<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class FireEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'enterprise_id',
        'file_id',
        'latitude',
        'longitude',
        'fire_power',
        'detected_at'
    ];

    protected $casts = [
        'detected_at' => 'datetime'
    ];

    // Связь с предприятием
    public function enterprise(): BelongsTo
    {
        return $this->belongsTo(AgriculturalEnterprise::class);
    }

    // Связь с файлом
    public function file(): BelongsTo
    {
        return $this->belongsTo(SatelliteFile::class);
    }

}
