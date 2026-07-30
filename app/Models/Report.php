<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [

        'generated_by',

        'employee_id',

        'report_name',

        'report_type',

        'description',

        'file_path',

        'generated_at',

    ];

    public function generator()
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
    public function manager()
    {
        return $this->belongsTo(User::class,'generated_by');
    }
}