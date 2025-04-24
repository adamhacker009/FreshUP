<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pollution extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'metan_detected',
        'nitrogen_oxide_detected',
        'black_carbon_detected',
        'temp_maps_now'
    ];
}
