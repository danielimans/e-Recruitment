@extends('layouts.dashboard')

@section('title', 'My Dashboard')

@section('content')

{{-- Welcome Banner --}}
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome back, {{ auth()->user()->name }}</h2>
        <p class="text-sm text-gray-500 mt-1">Track your job applications and career progress.</p>
    </div>
    <a href="{{ route('user.jobs.index') }}" class="btn-primary text-sm !py-2.5 !px-5 shadow-sm">
        <span class="material-symbols-outlined text-[18px]">search</span>
        Explore Opportunities
    </a>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <a href="{{ route('user.jobs.index') }}" class="stat-card group hover:border-indigo-150 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-full">Explore</span>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $totalJobs }}</h2>
        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wider">Available Jobs</p>
    </a>

    <a href="{{ route('user.applications') }}" class="stat-card group hover:border-blue-150 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-blue-600 bg-blue-50 px-2 py-0.5 rounded-full">History</span>
        </div>
        <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">{{ $totalApplications }}</h2>
        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wider">Applications Sent</p>
    </a>

    <div class="stat-card hover:border-amber-150 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-amber-50 text-amber-650 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-0.5 rounded-full">In Review</span>
        </div>
        <h2 class="text-3xl font-extrabold text-amber-500 tracking-tight">{{ $pendingApplications }}</h2>
        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wider">Pending Review</p>
    </div>

    <div class="stat-card hover:border-emerald-150 transition-all">
        <div class="flex items-center justify-between mb-4">
            <div class="w-11 h-11 bg-emerald-50 text-emerald-650 rounded-xl flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full">Success</span>
        </div>
        <h2 class="text-3xl font-extrabold text-emerald-605 tracking-tight">{{ $approvedApplications }}</h2>
        <p class="text-xs font-bold text-gray-400 mt-2 uppercase tracking-wider">Approved Jobs</p>
    </div>

</div>

{{-- Recent Applications --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-8">
    <div class="flex items-center justify-between px-6 py-5 border-b border-gray-100">
        <div>
            <h3 class="text-base font-bold text-gray-900 tracking-tight">Recent Applications</h3>
            <p class="text-xs text-gray-500 mt-1">Your latest job application activity</p>
        </div>
        <a href="{{ route('user.applications') }}"
           class="text-xs font-bold text-indigo-600 hover:text-indigo-700 transition">
            View All Applications →
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-slate-50/50 text-left border-b border-gray-100">
                    <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">Job Position</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">Applied</th>
                    <th class="px-6 py-3.5 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentApplications as $app)
                    <tr class="hover:bg-slate-50/40 transition">
                        <td class="px-6 py-4 font-semibold text-gray-800 text-sm">{{ $app->job->title }}</td>
                        <td class="px-6 py-4 text-gray-500 text-xs font-medium">{{ $app->created_at->format('M d, Y') }}</td>
                        <td class="px-6 py-4">
                            @if($app->status === 'Approved')
                                <span class="badge-approved">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    Approved
                                </span>
                            @elseif($app->status === 'Rejected')
                                <span class="badge-rejected">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    Rejected
                                </span>
                            @else
                                <span class="badge-pending">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                    Pending
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <span class="material-symbols-outlined text-[32px] text-gray-300">drafts</span>
                                <p class="text-sm font-medium">You haven't applied to any jobs yet.</p>
                                <a href="{{ route('user.jobs.index') }}"
                                   class="text-xs font-bold text-indigo-600 hover:underline">Browse Available Jobs</a>
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
    <h3 class="text-base font-bold text-gray-900 tracking-tight mb-5">Career Tips & Resources</h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="flex items-start gap-4 p-5 bg-indigo-50/50 rounded-2xl border border-indigo-100/50">
            <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[20px]">edit_document</span>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">Update Your Resume</p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Keep your professional credentials current to stand out from other candidates.</p>
                <a href="{{ route('user.resume') }}" class="text-xs font-bold text-indigo-600 hover:underline mt-3 inline-block">Open Resume Builder →</a>
            </div>
        </div>

        <div class="flex items-start gap-4 p-5 bg-blue-50/50 rounded-2xl border border-blue-100/50">
            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[20px]">forum</span>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">Interview Mastery</p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Research target employers extensively and practice answering behavioral queries.</p>
            </div>
        </div>

        <div class="flex items-start gap-4 p-5 bg-emerald-50/50 rounded-2xl border border-emerald-100/50">
            <div class="w-10 h-10 bg-emerald-50 text-emerald-650 rounded-xl flex items-center justify-center flex-shrink-0">
                <span class="material-symbols-outlined text-[20px]">query_stats</span>
            </div>
            <div>
                <p class="text-sm font-bold text-gray-800">Track Applications</p>
                <p class="text-xs text-gray-500 mt-1 leading-relaxed">Monitor interview cycles and application status updates in real-time.</p>
                <a href="{{ route('user.applications') }}" class="text-xs font-bold text-emerald-650 hover:underline mt-3 inline-block">My Applications →</a>
            </div>
        </div>

    </div>
</div>

@endsection
