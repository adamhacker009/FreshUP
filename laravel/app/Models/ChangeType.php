<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeType extends Model
{
    use HasFactory;

    protected $fillable = [
        'change_text'
    ];
}
