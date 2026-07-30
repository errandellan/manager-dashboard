<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'system_name',
        'company_name',
        'email',
        'logo',
        'registration_enabled'
    ];
}
