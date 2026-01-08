@extends('layouts.dashboard')

@section('title', 'Available Jobs')

@section('content')

{{-- Page Intro --}}
<div class="mb-6">
    <h2 class="text-xl font-semibold text-gray-800">Available Jobs</h2>
    <p class="text-sm text-gray-500">
        Discover and apply for the latest job opportunities
    </p>
</div>

{{-- Jobs Grid --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

    @forelse($jobs as $job)

        <div class="bg-white rounded-xl shadow-sm border hover:shadow-md transition p-5 flex flex-col justify-between">

            {{-- Job Info --}}
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">
                    {{ $job->title }}
                </h3>

                <p class="text-sm text-gray-500 mb-2">
                    📍 {{ $job->location }} · {{ $job->type ?? 'Full Time' }}
                </p>

                <p class="text-sm text-gray-600 line-clamp-3">
                    {{ $job->description }}
                </p>
            </div>

            {{-- Actions --}}
            <div class="mt-4 flex items-center justify-between">

                {{-- Application Status --}}
                @if(in_array($job->id, $appliedJobIds))
                    <span class="text-xs px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                        Applied (Pending)
                    </span>
                @else
                    <form method="POST" action="{{ route('apply.job', $job) }}">
                        @csrf
                        <button
                            class="px-4 py-2 text-sm font-medium rounded-lg
                                   bg-indigo-600 text-white hover:bg-indigo-700 transition">
                            Apply
                        </button>
                    </form>
                @endif

            </div>
        </div>

    @empty
        <div class="col-span-full text-center text-gray-500 py-12">
            No job openings available at the moment.
        </div>
    @endforelse

</div>

@endsection
