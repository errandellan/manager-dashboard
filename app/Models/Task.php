<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public $fillable = [
       'assigned_by',
        'assigned_to',
        'title',
        'description',
        'status',
        'priotity',
        'due_date',
        'review_status',
        'submitted_at',
        'approved_at',

    ];
    protected $casts = [
        'due_date' => 'datetime',
        'completed_at' => 'datetime',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    
    public function updates()
    {
        return $this->hasMany(TaskUpdate::class);
    }

    public function submission()
    {
        return $this->hasMany('TaskSubmission::class');
    }
}
