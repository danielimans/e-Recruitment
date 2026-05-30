@extends('layouts.dashboard')

@section('title', 'Available Jobs')

@section('content')

{{-- Page Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-900">Available Jobs</h2>
        <p class="text-sm text-gray-500 mt-1">Discover and apply for the latest opportunities</p>
    </div>
    <span class="text-sm font-semibold text-gray-500 bg-gray-100 px-3 py-1.5 rounded-lg">
        {{ $jobs->count() }} {{ Str::plural('position', $jobs->count()) }}
    </span>
</div>

{{-- Jobs Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($jobs as $job)

        @php $appStatus = $appliedJobs[$job->id] ?? null; @endphp

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md hover:-translate-y-0.5 transition-all duration-200 flex flex-col">

            {{-- Card Header --}}
            <div class="p-5 flex-1">
                <div class="flex items-start justify-between gap-3 mb-3">
                    <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                        </svg>
                    </div>
                    @if($appStatus)
                        @if($appStatus === 'Approved')
                            <span class="badge-approved text-xs">Approved</span>
                        @elseif($appStatus === 'Rejected')
                            <span class="badge-rejected text-xs">Rejected</span>
                        @else
                            <span class="badge-pending text-xs">Applied</span>
                        @endif
                    @endif
                </div>

                <h3 class="text-base font-bold text-gray-900 mb-1">{{ $job->title }}</h3>

                <p class="text-sm text-gray-500 mb-3 flex items-center gap-1.5">
                    <svg class="w-3.5 h-3.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    {{ $job->location }}
                    @if($job->type ?? null)
                        <span class="text-gray-300">·</span>
                        {{ $job->type }}
                    @endif
                </p>

                <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed">
                    {{ $job->description }}
                </p>
            </div>

            {{-- Card Footer --}}
            <div class="px-5 pb-5 pt-3 border-t border-gray-50">
                @if($appStatus)
                    <div class="flex items-center gap-2 text-sm
                        {{ $appStatus === 'Approved' ? 'text-emerald-600' : ($appStatus === 'Rejected' ? 'text-red-500' : 'text-amber-600') }}">
                        @if($appStatus === 'Approved')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            Your application was approved
                        @elseif($appStatus === 'Rejected')
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            Application not selected
                        @else
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                            Application under review
                        @endif
                    </div>
                @else
                    <form method="POST" action="{{ route('apply.job', $job) }}">
                        @csrf
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl transition-all hover:-translate-y-0.5 active:translate-y-0">
                            Apply Now
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                            </svg>
                        </button>
                    </form>
                @endif
            </div>
        </div>

    @empty
        <div class="col-span-full py-14 text-center">
            <div class="flex flex-col items-center gap-3 text-gray-400">
                <svg class="w-12 h-12" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                </svg>
                <p class="text-sm font-medium text-gray-500">No job openings available at the moment.</p>
                <p class="text-xs text-gray-400">Check back soon for new opportunities.</p>
            </div>
        </div>
    @endforelse

</div>

@endsection
