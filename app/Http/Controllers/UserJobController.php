<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class UserJobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('user.jobs.index', compact('jobs'));
    }
}
