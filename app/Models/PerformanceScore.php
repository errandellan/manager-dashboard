<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerformanceScore extends Model
{

    protected $fillable = [

        'user_id',
        'attendance_score',
        'activity_score',
        'task_completion_score',
        'overall_score',
        'rank',
        'evaluated_month'

    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

}