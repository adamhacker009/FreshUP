<?php

use App\Models\ChangeLog;
use App\Models\EmissionMetric;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function emissionMetrics()
    {
        return $this->hasMany(EmissionMetric::class);
    }
    public function changeLogs()
    {
        return $this->hasMany(ChangeLog::class);
    }
}
