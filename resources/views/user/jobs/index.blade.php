@extends('layouts.dashboard')

@section('title', 'Available Jobs')

@section('content')

{{-- Page Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900 tracking-tight">Available Jobs</h2>
        <p class="text-sm text-gray-500 mt-1">Discover and apply for the latest opportunities</p>
    </div>
    <span class="text-xs font-bold text-gray-500 bg-gray-150/60 px-3 py-1.5 rounded-lg border border-gray-200/40">
        {{ $jobs->count() }} {{ Str::plural('position', $jobs->count()) }}
    </span>
</div>

{{-- Jobs Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($jobs as $job)

        @php $appStatus = $appliedJobs[$job->id] ?? null; @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100/80 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">

            {{-- Card Header --}}
            <div class="p-6 flex-1">
                <div class="flex items-start justify-between gap-3 mb-4">
                    <div class="w-11 h-11 bg-gradient-to-br from-indigo-50 to-indigo-100/30 text-indigo-650 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:scale-105 transition-transform duration-300 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                        </svg>
                    </div>
                    @if($appStatus)
                        @if($appStatus === 'Approved')
                            <span class="badge-approved text-[10px] font-bold uppercase tracking-wider">Approved</span>
                        @elseif($appStatus === 'Rejected')
                            <span class="badge-rejected text-[10px] font-bold uppercase tracking-wider">Rejected</span>
                        @else
                            <span class="badge-pending text-[10px] font-bold uppercase tracking-wider">Applied</span>
                        @endif
                    @endif
                </div>

                <h3 class="text-base font-extrabold text-gray-900 mb-1.5 tracking-tight group-hover:text-indigo-600 transition-colors duration-200">{{ $job->title }}</h3>

                <p class="text-xs font-semibold text-gray-400 mb-4 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[16px] text-gray-400">location_on</span>
                    {{ $job->location }}
                    @if($job->type ?? null)
                        <span class="text-gray-300">·</span>
                        <span class="bg-slate-100 px-2 py-0.5 rounded text-[10px] font-bold text-slate-500 uppercase tracking-wide">{{ $job->type }}</span>
                    @endif
                </p>

                <p class="text-xs text-gray-500 line-clamp-3 leading-relaxed">
                    {{ $job->description }}
                </p>
            </div>

            {{-- Card Footer --}}
            <div class="px-6 pb-6 pt-4 border-t border-slate-50">
                @if($appStatus)
                    <div class="flex items-center gap-2 text-xs font-semibold
                        {{ $appStatus === 'Approved' ? 'text-emerald-600' : ($appStatus === 'Rejected' ? 'text-red-500' : 'text-amber-600') }}">
                        @if($appStatus === 'Approved')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Application approved
                        @elseif($appStatus === 'Rejected')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Application not selected
                        @else
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            Under review
                        @endif
                    </div>
                @else
                    <form method="POST" action="{{ route('apply.job', $job) }}">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-650 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all hover:-translate-y-0.5 active:translate-y-0 shadow-sm shadow-indigo-500/10 cursor-pointer">
                            Apply Now
                            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>

    @empty
        <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center gap-3 text-gray-400">
                <span class="material-symbols-outlined text-[40px] text-gray-300">search_off</span>
                <p class="text-sm font-semibold text-gray-700">No job openings available right now.</p>
                <p class="text-xs text-gray-400">Please check back later for updates.</p>
            </div>
        </div>
    @endforelse

</div>

@endsection
