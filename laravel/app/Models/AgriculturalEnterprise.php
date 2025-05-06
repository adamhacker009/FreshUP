<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasMany;

class AgriculturalEnterprise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'latitude',
        'longitude',
        'rating'
    ];

    public function emissionMetrics(): HasMany
    {
        return $this->hasMany(EmissionMetric::class);
    }

    public function fireEvents(): HasMany
    {
        return $this->hasMany(FireEvent::class);
    }

    public function calculateRating(): void
    {
        $averageEmission = $this->emissionMetrics()
            ->where('measured_at', '>', now()->subMonth())
            ->avg('value');

        $this->update([
            'rating' => max(0, 5 - ($averageEmission / 100))
        ]);
    }
}
