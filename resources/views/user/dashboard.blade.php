@extends('layouts.dashboard')

@section('title', 'My Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="mb-8">
    <h2 class="text-xl font-bold text-gray-900">Welcome back, {{ auth()->user()->name }}</h2>
    <p class="text-sm text-gray-500 mt-1">Track your job applications and career progress.</p>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <a href="{{ route('user.jobs.index') }}" class="stat-card group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-indigo-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                </svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">{{ $totalJobs }}</h2>
        <p class="text-sm text-gray-500 mt-1">Available Jobs</p>
    </a>

    <a href="{{ route('user.applications') }}" class="stat-card group">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-gray-900">{{ $totalApplications }}</h2>
        <p class="text-sm text-gray-500 mt-1">Applications Sent</p>
    </a>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-amber-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-amber-500">{{ $pendingApplications }}</h2>
        <p class="text-sm text-gray-500 mt-1">Pending</p>
    </div>

    <div class="stat-card">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-emerald-50 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <h2 class="text-3xl font-bold text-emerald-600">{{ $approvedApplications }}</h2>
        <p class="text-sm text-gray-500 mt-1">Approved</p>
    </div>

</div>

{{-- Recent Applications --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <div>
            <h3 class="text-base font-bold text-gray-900">Recent Applications</h3>
            <p class="text-sm text-gray-500 mt-0.5">Your latest job application activity</p>
        </div>
        <a href="{{ route('user.applications') }}"
           class="text-sm font-semibold text-indigo-600 hover:text-indigo-700 transition">
            View all →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left">
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Job Position</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Applied</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentApplications as $app)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $app->job->title }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($app->status === 'Approved')
                                <span class="badge-approved">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    Approved
                                </span>
                            @elseif($app->status === 'Rejected')
                                <span class="badge-rejected">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    Rejected
                                </span>
                            @else
                                <span class="badge-pending">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-10 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm">You haven't applied to any jobs yet.</p>
                                <a href="{{ route('user.jobs.index') }}"
                                   class="text-sm font-semibold text-indigo-600 hover:underline">Browse available jobs →</a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Career Tips --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
    <h3 class="text-base font-bold text-gray-900 mb-5">Career Tips</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div class="flex items-start gap-4 p-4 bg-indigo-50 rounded-xl border border-indigo-100">
            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">Update Your Resume</p>
                <p class="text-xs text-gray-500 mt-1">Keep your skills and experience current to stand out.</p>
                <a href="{{ route('user.resume') }}" class="text-xs font-semibold text-indigo-600 hover:underline mt-2 inline-block">Go to Resume Builder →</a>
            </div>
        </div>

        <div class="flex items-start gap-4 p-4 bg-blue-50 rounded-xl border border-blue-100">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">Prepare for Interviews</p>
                <p class="text-xs text-gray-500 mt-1">Research the company and practice common questions.</p>
            </div>
        </div>

        <div class="flex items-start gap-4 p-4 bg-emerald-50 rounded-xl border border-emerald-100">
            <div class="w-10 h-10 bg-emerald-100 rounded-lg flex items-center justify-center flex-shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">Track Your Progress</p>
                <p class="text-xs text-gray-500 mt-1">Monitor all application statuses from your dashboard.</p>
                <a href="{{ route('user.applications') }}" class="text-xs font-semibold text-emerald-600 hover:underline mt-2 inline-block">View Applications →</a>
            </div>
        </div>

    </div>
</div>

@endsection
