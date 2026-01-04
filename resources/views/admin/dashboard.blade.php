@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Jobs --}}
    <a href="{{ route('jobs.index') }}"
    class="block bg-white rounded-xl shadow p-6
            hover:shadow-lg hover:ring-2 hover:ring-indigo-500
            transition">

        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Jobs</p>
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $totalJobs }}
                </h2>
            </div>
            <div class="p-3 rounded-full bg-indigo-100 text-indigo-600">
                💼
            </div>
        </div>
    </a>

    {{-- Total Applications --}}
    <a href="{{ route('admin.applications') }}"
    class="block bg-white rounded-xl shadow p-6
            hover:shadow-lg hover:ring-2 hover:ring-blue-500
            transition">

        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Total Applications</p>
                <h2 class="text-3xl font-bold text-gray-800">
                    {{ $totalApplications }}
                </h2>
            </div>
            <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                📄
            </div>
        </div>
    </a>

    {{-- Pending Applications --}}
    <a href="{{ route('admin.applications', ['status' => 'Pending']) }}"
    class="block bg-white rounded-xl shadow p-6
            hover:shadow-lg hover:ring-2 hover:ring-red-500
            transition">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm text-gray-500">Pending Applications</p>
                <h2 class="text-3xl font-bold text-red-600">
                    {{ $pendingApplications }}
                </h2>
            </div>
            <div class="p-3 rounded-full bg-red-100 text-red-600">
                ⏳
            </div>
        </div>
    </a>

    {{-- Recent Applications --}}
    <div class="bg-white rounded-xl shadow p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-800">
                Recent Applications
            </h3>

            <a href="{{ route('admin.applications') }}"
            class="text-sm text-indigo-600 hover:underline">
                View all
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left">Applicant</th>
                        <th class="px-4 py-2 text-left">Job</th>
                        <th class="px-4 py-2 text-left">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @forelse($recentApplications as $app)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-3">
                                {{ $app->user->name }}
                            </td>

                            <td class="px-4 py-3">
                                {{ $app->job->title }}
                            </td>

                            <td class="px-4 py-3">
                                @if($app->status === 'Approved')
                                    <span class="px-3 py-1 text-xs rounded-full
                                                bg-green-100 text-green-700">
                                        Approved
                                    </span>
                                @elseif($app->status === 'Rejected')
                                    <span class="px-3 py-1 text-xs rounded-full
                                                bg-red-100 text-red-700">
                                        Rejected
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full
                                                bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3"
                                class="px-4 py-4 text-center text-gray-500">
                                No applications yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Optional message --}}
<p class="text-gray-500">
    Welcome back, Admin. Use the sidebar to manage jobs and applications.
</p>

@endsection
