@extends('layouts.dashboard')

@section('title', 'User Dashboard')

@section('content')

<p class="text-gray-600 mb-6">
    Welcome back, <span class="font-semibold">{{ auth()->user()->name }}</span> 👋
</p>

{{-- ================= SUMMARY CARDS ================= --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Available Jobs</p>
        <h2 class="text-3xl font-bold text-indigo-600">
            {{ $totalJobs }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Applications Sent</p>
        <h2 class="text-3xl font-bold text-blue-600">
            {{ $totalApplications }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Pending</p>
        <h2 class="text-3xl font-bold text-yellow-500">
            {{ $pendingApplications }}
        </h2>
    </div>

    <div class="bg-white rounded-xl shadow p-5">
        <p class="text-sm text-gray-500">Approved</p>
        <h2 class="text-3xl font-bold text-green-600">
            {{ $approvedApplications }}
        </h2>
    </div>

</div>

{{-- ================= RECENT APPLICATIONS ================= --}}
<div class="bg-white rounded-xl shadow p-6 mb-8">
    <h3 class="text-lg font-semibold mb-4">
        Recent Applications
    </h3>

    <table class="w-full text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Job</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentApplications as $app)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $app->job->title }}</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded text-xs
                            {{ $app->status === 'Approved' ? 'bg-green-100 text-green-700' :
                               ($app->status === 'Rejected' ? 'bg-red-100 text-red-700' :
                               'bg-yellow-100 text-yellow-700') }}">
                            {{ $app->status }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center text-gray-500 py-4">
                        No applications yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- ================= MULTIMEDIA / CAREER TIPS ================= --}}
<div class="bg-white rounded-xl shadow p-6">
    <h3 class="text-lg font-semibold mb-4">
        Career Tips
    </h3>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">

        <div class="p-4 border rounded-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
                 alt="Resume" class="w-16 mx-auto mb-3">
            <p class="text-sm font-medium">
                Keep your resume updated
            </p>
        </div>

        <div class="p-4 border rounded-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/2921/2921222.png"
                 alt="Interview" class="w-16 mx-auto mb-3">
            <p class="text-sm font-medium">
                Prepare for interviews early
            </p>
        </div>

        <div class="p-4 border rounded-lg">
            <img src="https://cdn-icons-png.flaticon.com/512/942/942748.png"
                 alt="Tracking" class="w-16 mx-auto mb-3">
            <p class="text-sm font-medium">
                Track your application status
            </p>
        </div>

    </div>
</div>

@endsection
