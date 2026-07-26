<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $fillable = [
        'department_id',
        'job_title',
        'description',

    ];

    protected $cast = [
        'created_at' => 'dateime',
        'updated_at' => 'datetime'

    ];
    
}
