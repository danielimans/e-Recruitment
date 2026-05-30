<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'location' => 'required'
        ]);

        Job::create($request->only([
            'title',
            'description',
            'location',
        ]));

        return redirect()->route('jobs.index')
            ->with('success', 'Job created successfully');
    }

    public function edit(Job $job)
    {
        return view('admin.jobs.edit', compact('job'));
    }

    public function update(Request $request, Job $job)
    {
        $request->validate([
        'title' => 'required|min:3',
        'description' => 'required',
        'location' => 'required'
    ]);

    $job->update($request->only([
        'title',
        'description',
        'location',
    ]));

    return redirect()->route('jobs.index')
        ->with('success', 'Job updated successfully');
    }
}
