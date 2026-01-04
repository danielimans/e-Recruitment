@php use Illuminate\Support\Str; @endphp

@extends('layouts.dashboard')

@section('title', 'Available Jobs')

@section('content')

<div class="mb-6">
    <h2 class="text-2xl font-bold text-gray-800">
        Available Jobs
    </h2>
    <p class="text-gray-500">
        Discover and apply for the latest job opportunities
    </p>
</div>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

    @foreach($jobs as $job)
        <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-5 flex flex-col">

            {{-- Job Title --}}
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                {{ $job->title }}
            </h3>

            {{-- Location & Type --}}
            <p class="text-sm text-gray-500 mb-2">
                📍 {{ $job->location }} • Full Time
            </p>

            {{-- Description --}}
            <p class="text-sm text-gray-600 flex-grow">
                {{ Str::limit($job->description, 120) }}
            </p>

            {{-- Salary (optional, if column exists) --}}
            @if(!empty($job->salary))
                <p class="mt-3 font-semibold text-red-600">
                    MYR {{ $job->salary }}
                </p>
            @endif

            {{-- Apply Section --}}
            @if(isset($applications[$job->id]))

                @php
                    $status = $applications[$job->id]->status;
                @endphp

                {{-- Applied badge + button --}}
                <div class="mt-4 flex items-center justify-between">
                    <span class="inline-flex items-center px-3 py-1
                                text-xs font-semibold
                                bg-green-100 text-green-700
                                rounded-full">
                        ✔ Applied
                    </span>

                    <button
                        disabled
                        class="px-4 py-2 text-sm rounded-lg
                            bg-gray-300 text-gray-600
                            cursor-not-allowed">
                        Applied
                    </button>
                </div>

                {{-- REAL STATUS --}}
                <span class="mt-2 block text-xs
                    {{ $status === 'Approved' ? 'text-green-600' : 
                    ($status === 'Rejected' ? 'text-red-600' : 'text-yellow-600') }}">
                    Status: {{ $status }}
                </span>

            @else

                <form method="POST"
                    action="{{ route('apply.job', $job) }}"
                    class="mt-4">
                    @csrf
                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700
                            text-white py-2 rounded-lg transition">
                        Apply Now
                    </button>
                </form>

            @endif
        </div>
    @endforeach

</div>

@endsection
