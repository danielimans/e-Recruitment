<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('user.dashboard');
    }

    public function applications()
    {
        $applications = Application::with('job')
            ->where('user_id', Auth::id())
            ->get();

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
}