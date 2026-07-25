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
        'due_date',
    ];
    protected $casts = [
        'completed_at' => 'datetime',
    ];

    public function manager()
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
