@extends('layouts.dashboard')

@section('title', 'Applications')

@section('content')

{{-- Page Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Job Applications</h2>
        <p class="text-sm text-gray-500 mt-1">Review and manage all candidate applications</p>
    </div>
    <span class="text-sm font-semibold text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">
        {{ $applications->count() }} {{ Str::plural('application', $applications->count()) }}
    </span>
</div>

{{-- Status Filter Tabs --}}
<div class="flex items-center gap-2 mb-6 flex-wrap">
    <a href="{{ route('admin.applications') }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold transition
              {{ !request('status') ? 'bg-indigo-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-indigo-300 hover:text-indigo-600' }}">
        All
    </a>
    <a href="{{ route('admin.applications', ['status' => 'Pending']) }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold transition
              {{ request('status') === 'Pending' ? 'bg-amber-500 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-amber-300 hover:text-amber-600' }}">
        Pending
    </a>
    <a href="{{ route('admin.applications', ['status' => 'Approved']) }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold transition
              {{ request('status') === 'Approved' ? 'bg-emerald-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-emerald-300 hover:text-emerald-600' }}">
        Approved
    </a>
    <a href="{{ route('admin.applications', ['status' => 'Rejected']) }}"
       class="px-4 py-2 rounded-lg text-sm font-semibold transition
              {{ request('status') === 'Rejected' ? 'bg-red-600 text-white shadow-sm' : 'bg-white text-gray-600 border border-gray-200 hover:border-red-300 hover:text-red-600' }}">
        Rejected
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 text-left border-b border-gray-100">
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Applicant</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Job Position</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Applied</th>
                    <th class="px-6 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status / Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-50">
                @forelse($applications as $app)
                    <tr class="hover:bg-gray-50 transition">
                        {{-- Applicant --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-700 text-sm font-bold flex-shrink-0">
                                    {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $app->user->name }}</p>
                                    <p class="text-xs text-gray-400">{{ $app->user->email }}</p>
                                </div>
                            </div>
                        </td>

                        {{-- Job --}}
                        <td class="px-6 py-4">
                            <p class="font-medium text-gray-800">{{ $app->job->title }}</p>
                            @if($app->job->location)
                                <p class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $app->job->location }}
                                </p>
                            @endif
                        </td>

                        {{-- Date --}}
                        <td class="px-6 py-4 text-gray-500">
                            <p class="text-sm">{{ $app->created_at->format('M d, Y') }}</p>
                            <p class="text-xs text-gray-400">{{ $app->created_at->diffForHumans() }}</p>
                        </td>

                        {{-- Status / Action --}}
                        <td class="px-6 py-4">
                            @if($app->status === 'Pending')
                                <div class="flex items-center gap-2">
                                    <form method="POST" action="{{ route('applications.approve', $app) }}">
                                        @csrf
                                        <button class="btn-success text-xs px-3 py-1.5 rounded-lg">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                            </svg>
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('applications.reject', $app) }}">
                                        @csrf
                                        <button class="btn-danger text-xs px-3 py-1.5 rounded-lg">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                            Reject
                                        </button>
                                    </form>
                                </div>
                            @elseif($app->status === 'Approved')
                                <span class="badge-approved">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                    Approved
                                </span>
                            @else
                                <span class="badge-rejected">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                    Rejected
                                </span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center gap-3 text-gray-400">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-sm font-medium">No applications found</p>
                                @if(request('status'))
                                    <a href="{{ route('admin.applications') }}"
                                       class="text-sm text-indigo-600 font-semibold hover:underline">
                                        Clear filter
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
