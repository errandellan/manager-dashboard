<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskSubmission extends Model
{
    protected $fillable = [

        'task_id',

        'submitted_by',

        'submission_type',

        'file_path',

        'project_link',

        'comment',

        'submitted_at',

        'status',

    ];

    protected $casts = [

        'submitted_at' => 'datetime',

    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'submitted_by');
    }
}