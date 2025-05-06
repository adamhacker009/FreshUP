<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ChangeLog extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'change_type',
        'changeable_id',
        'changeable_type',
        'old_data',
        'new_data'
    ];

    protected $casts = [
        'old_data' => 'array',
        'new_data' => 'array'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function changeable(): MorphTo
    {
        return $this->morphTo();
    }
}
