<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Application;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $userName = Auth::check() ? Auth::user()->name : '';

        $query = DB::table('jobs');

        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%')
                  ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        $jobs = $query->latest()->get();

        // Map job_id => status so the view can show real application state
        $appliedJobs = Auth::check()
            ? Application::where('user_id', Auth::id())->pluck('status', 'job_id')->toArray()
            : [];

        return view('home', compact('jobs', 'userName', 'appliedJobs'));
    }
}
