<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function index()
    {

        // 1. Get the current logged-in user's ID
        $userId = Auth::id();

        // 2. Find their resume in the database (with their experience list)
        $resume = Resume::with('experiences')->where('user_id', $userId)->first();

        // 3. Send this $resume variable to the view
        return view('user.resume-builder', compact('resume'));
    }

    public function store(Request $request)
    {
        // 1. Validate Input
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email',
            // Allow experiences to be an array
            'experiences' => 'nullable|array',
            'experiences.*.role' => 'nullable|string',
        ]);

        // 2. Create or Update the Main Resume
        // We use updateOrCreate so the user doesn't create 50 resumes, just updates their one.
        $resume = Resume::updateOrCreate(
            ['user_id' => Auth::id()], // Search by
            [
                'full_name' => $request->full_name,
                'job_title' => $request->job_title,
                'email' => $request->email,
                'phone' => $request->phone,
                'location' => $request->location,
                'summary' => $request->summary,
                'skills' => $request->skills,
            ] // Data to update/create
        );

        // 3. Handle Experiences (Delete old ones and re-add new ones for simplicity)
        if ($request->has('experiences')) {
            $resume->experiences()->delete(); // Clear old

            foreach ($request->experiences as $exp) {
                // Only save if at least a role or company is provided
                if (! empty($exp['role']) || ! empty($exp['company'])) {
                    $resume->experiences()->create($exp);
                }
            }
        }

        return redirect()->back()->with('success', 'Resume saved successfully!');
    }
}
