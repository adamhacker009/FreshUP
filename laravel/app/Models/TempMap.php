<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempMap extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'metan_map',
        'nitrogen_oxide_map',
        'black_carbon_map'
    ];
}
