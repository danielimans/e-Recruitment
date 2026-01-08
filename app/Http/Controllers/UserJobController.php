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

    $appliedJobIds = Application::where('user_id', Auth::id())
        ->pluck('job_id')
        ->toArray();

    return view('user.jobs.index', compact('jobs', 'appliedJobIds'));
}
}
