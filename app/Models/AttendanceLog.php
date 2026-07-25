<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AttendanceLog extends Model
{
    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
        'session_duration',
        'status',
    ];
    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}