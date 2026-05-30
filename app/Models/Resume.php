<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    protected $fillable = [
        'user_id', 'full_name', 'job_title', 'email',
        'phone', 'location', 'linkedin', 'github', 'summary', 'skills', // Added linkedin, github
    ];

    public function experiences(): HasMany
    {
        return $this->hasMany(ResumeExperience::class);
    }
}
