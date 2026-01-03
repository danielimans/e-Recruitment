<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use App\Models\Application;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function applications()
    {
        $applications = Application::with('job', 'user')->get();
        return view('admin.applications.index', compact('applications'));
    }
}
