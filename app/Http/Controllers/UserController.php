<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
         $userId = Auth::id();

        $totalJobs = Job::count();

        $totalApplications = Application::where('user_id', $userId)->count();

        $pendingApplications = Application::where('user_id', $userId)->where('status', 'Pending')->count();

        $approvedApplications = Application::where('user_id', $userId)->where('status', 'Approved')->count();

        $recentApplications = Application::with('job')
            ->where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        // Notifications (Approved / Rejected only)
        $notifications = Application::with('job')
            ->where('user_id', $userId)
            ->whereIn('status', ['Approved', 'Rejected'])
            ->latest()
            ->take(5)
            ->get();

        return view('user.dashboard', compact(
            'totalJobs',
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'recentApplications',
            'notifications'
        ));
    }

    public function applications()
    {
        $applications = Application::with('job')->where('user_id', Auth::id())->get();

        return view('user.applications.index', compact('applications'));
    }

    public function profile()
    {
        return view('user.profile');
    }

    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        User::findOrFail(Auth::id())->update($validated);

        return back()->with('success', 'Profile updated successfully');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        // Check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Current password is incorrect.',
            ]);
        }

        // Update password
        /** @var User $user */
        $user = Auth::user();

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully.');
    }
}