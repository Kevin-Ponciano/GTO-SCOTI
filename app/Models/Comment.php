<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'date_time_create',
        'private',
        'user_id',
        'task_id'
    ];
}
