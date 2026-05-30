<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class UserJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();

        // Map job_id => status so the view can show the actual application state
        $appliedJobs = Application::where('user_id', Auth::id())
            ->pluck('status', 'job_id')
            ->toArray();

        return view('user.jobs.index', compact('jobs', 'appliedJobs'));
    }
}
