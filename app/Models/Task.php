<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
        'situation',
        'user_id',
        'team_id'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
