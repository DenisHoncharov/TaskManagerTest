<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public const AVAILABLE_TASK_STATUSES = [
        'Pending',
        'In Progress',
        'Done'
    ];

    protected $fillable = [
        'title',
        'description',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
