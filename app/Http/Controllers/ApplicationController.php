<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * USER applies for a job
     */
    public function store(Job $job)
    {
        Application::firstOrCreate([
            'user_id' => Auth::id(),
            'job_id'  => $job->id,
        ]);

        return back()->with('success', 'Applied successfully');
    }

    /**
     * ADMIN approves application
     */
    public function approve(Application $application)
    {
        $application->update([
            'status' => 'Approved',
        ]);

        return back()->with('success', 'Application approved');
    }

    /**
     * ADMIN rejects application
     */
    public function reject(Application $application)
    {
        $application->update([
            'status' => 'Rejected',
        ]);

        return back()->with('success', 'Application rejected');
    }
}
