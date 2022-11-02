<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'priority',
        'date_create',
        'deadline',
        'status',
        'situation',
        'user_id',
        'team_id'
    ];
}
