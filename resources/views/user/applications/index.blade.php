@extends('layouts.dashboard')

@section('title', 'My Applications')

@section('content')

<div class="bg-white rounded-xl shadow p-6">
    <table class="w-full">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Job</th>
                <th class="px-4 py-2 text-left">Status</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse($applications as $app)
                <tr>
                    <td class="px-4 py-3">{{ $app->job->title }}</td>
                    <td class="px-4 py-3">
                        @if($app->status === 'Approved')
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                Approved
                            </span>
                        @elseif($app->status === 'Rejected')
                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                Rejected
                            </span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                Pending
                            </span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center py-4 text-gray-500">
                        No applications yet.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
