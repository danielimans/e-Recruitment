<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Application;

class AdminController extends Controller
{
    public function index()
    {
        $totalJobs = Job::count();
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'Pending')->count();
        $recentApplications = Application::with('user', 'job')->latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalJobs' => $totalJobs,
            'totalApplications' => $totalApplications,
            'pendingApplications' => $pendingApplications,
            'recentApplications' => $recentApplications,
        ]);
    }

    public function applications(Request $request)
    {
        $query = Application::with('job', 'user');

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $applications = $query->get();

        return view('admin.applications.index', compact('applications'));
    }
}
