<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();

        // Get user's applications keyed by job_id
        $applications = Application::where('user_id', Auth::id())
            ->get()
            ->keyBy('job_id');

        return view('user.jobs.index', compact('jobs', 'applications'));
    }
}
