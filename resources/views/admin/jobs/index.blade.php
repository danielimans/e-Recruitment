@extends('layouts.dashboard')

@section('title', 'Manage Jobs')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div class="mb-6 rounded-lg bg-green-100 px-4 py-3 text-green-800">
        {{ session('success') }}
    </div>
@endif

{{-- Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h2 class="text-xl font-semibold text-gray-800">Job Listings</h2>
        <p class="text-sm text-gray-500">Manage available job positions</p>
    </div>

    <a href="{{ route('jobs.create') }}"
       class="inline-flex items-center rounded-lg bg-indigo-600 px-4 py-2 text-white hover:bg-indigo-700 transition">
        + Add Job
    </a>
</div>

{{-- Table Card --}}
<div class="bg-white rounded-xl shadow overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Title</th>
                <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Location</th>
                <th class="px-6 py-3 text-right text-sm font-semibold text-gray-600">Action</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse($jobs as $job)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $job->title }}
                    </td>

                    <td class="px-6 py-4 text-gray-700">
                        {{ $job->location }}
                    </td>

                    <td class="px-6 py-4 text-right space-x-3">
                        <a href="{{ route('jobs.edit', $job) }}"
                           class="text-indigo-600 hover:text-indigo-800 font-medium">
                            Edit
                        </a>

                        <form action="{{ route('jobs.destroy', $job) }}"
                              method="POST"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete this job?')"
                                    class="text-red-600 hover:text-red-800 font-medium">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="px-6 py-6 text-center text-gray-500">
                        No jobs available.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
