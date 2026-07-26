<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'department_name',
        'description'];

    public function users()
    {
        // A department has many users
        return $this->hasMany(User::class);
    }
    public function jobs()
    {
        // A department has many jobs
        return $this->hasMany(Job::class);
    }
}