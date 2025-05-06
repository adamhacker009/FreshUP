<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SatelliteSource extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'data_type'
    ];

    public function satelliteFiles(): HasMany
    {
        return $this->hasMany(SatelliteFile::class);
    }
}
