<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeExperience extends Model
{
    protected $fillable = [
        'resume_id', 'role', 'company', 'date_range', 'description'
    ];
}