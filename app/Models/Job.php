<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // FIX: Change this to 'jobs' to match your database and migration
    protected $table = 'jobs';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'location',
        // I added these because your report mentions them.
        // If you don't list them here, they won't save to the DB!
        'salary',
        'type',
    ];
}
