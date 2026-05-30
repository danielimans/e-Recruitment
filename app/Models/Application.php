<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_id',
        'status',
    ];

    // ✅ FIX #1: relationship to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ FIX #2: relationship to Job
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
