@extends('layouts.dashboard')

@section('title', 'Applications')

@section('content')

<div class="bg-white rounded-xl shadow p-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-semibold text-gray-800">Job Applications</h2>
            <p class="text-sm text-gray-500">List of applicants and their application status</p>
        </div>
    </div>

    @if(request('status'))
        <div class="mb-4 text-sm text-gray-600">
            Showing applications with status:
            <span class="font-semibold">{{ request('status') }}</span>
            <a href="{{ route('admin.applications') }}"
            class="ml-2 text-indigo-600 underline">
                Clear filter
            </a>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Applicant</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Job</th>
                    <th class="px-4 py-3 text-left text-sm font-semibold text-gray-600">Status</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($applications as $app)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-800 font-medium">
                        {{ $app->user->name }}
                    </td>

                    <td class="px-4 py-3 text-gray-700">
                        {{ $app->job->title }}
                    </td>

                    <td class="px-4 py-3">
                        @if($app->status === 'Pending')
                            <div class="flex gap-2">
                                <form method="POST"
                                    action="{{ route('applications.approve', $app) }}">
                                    @csrf
                                    <button class="px-3 py-1 text-xs font-semibold
                                                bg-green-600 text-white rounded
                                                hover:bg-green-700">
                                        Approve
                                    </button>
                                </form>

                                <form method="POST"
                                    action="{{ route('applications.reject', $app) }}">
                                    @csrf
                                    <button class="px-3 py-1 text-xs font-semibold
                                                bg-red-600 text-white rounded
                                                hover:bg-red-700">
                                        Reject
                                    </button>
                                </form>
                            </div>
                        @elseif($app->status === 'Approved')
                            <span class="px-3 py-1 text-xs font-semibold
                                        bg-green-100 text-green-700 rounded-full">
                                Approved
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs font-semibold
                                        bg-red-100 text-red-700 rounded-full">
                                Rejected
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-4 py-6 text-center text-gray-500">
                        No applications found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
