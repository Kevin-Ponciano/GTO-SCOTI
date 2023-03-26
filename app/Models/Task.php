<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'priority',
        'date_create',
        'deadline',
        'status',
        'situation',
        'user_id',
        'team_id',
        'scheduled_task_id'
    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function scheduledTask(): BelongsTo
    {
        return $this->belongsTo(ScheduledTask::class);
    }
}
