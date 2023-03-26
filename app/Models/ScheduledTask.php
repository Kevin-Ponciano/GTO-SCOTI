<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ScheduledTask extends Model
{
    protected $fillable = [
        'date',
        'hour',
        'recorrence_count',
        'frequency'
    ];

    public function task(): HasOne
    {
        return $this->hasOne(Task::class);
    }
}
