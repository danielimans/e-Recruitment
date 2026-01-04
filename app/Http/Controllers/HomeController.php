<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Get the current user's name (if logged in)
        $userName = Auth::check() ? Auth::user()->name : ''; 

        // 2. Query the 'jobs' table (matching your SQL structure)
        $query = DB::table('jobs'); 

        // 3. Search Logic
        if ($request->filled('q')) {
            $search = $request->input('q');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')       // Matches 'title' column in SQL
                  ->orWhere('description', 'like', '%' . $search . '%') // Matches 'description' column
                  ->orWhere('location', 'like', '%' . $search . '%');   // Matches 'location' column
            });
        }

        $jobs = $query->get();

        return view('home', compact('jobs', 'userName'));
    }
}