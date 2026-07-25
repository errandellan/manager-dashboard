<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Role;
use App\Models\Department;
use App\Models\Report;
use App\Models\AttendanceLog;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Task;




#[Fillable(['name',
    'email',
    'phone',
    'password',
    'role_id',
    'department_id',
    'job_id',
    'status',])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, SoftDeletes; 

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function reports()
    {
        return $this->hasMany(Report::class); // Assuming Report is the model for the reports table

    }
    //One user belongs to one department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function attendanceLogs()
    {
        return $this->hasMany(AttendanceLog::class);
    }
    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_by');
    }
    public function receivedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

}
