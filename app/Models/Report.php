<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //status: pending, approved, rejected
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';
    
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
