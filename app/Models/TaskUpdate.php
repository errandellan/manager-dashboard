<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskUpdate extends Model
{
    protected $fillable = [

    'task_id',

    'updated_by',

    'progress',

    'comment',

    'submission_type',

    'file_path',

    'submission_link',

    'manager_feedback',

    'submitted_at',

    'reviewed_at',

];
public function task()
{
    return $this->belongsTo(Task::class);
}

public function user()
{
    return $this->belongsTo(User::class, 'updated_by');
}
}
