@extends('layouts.dashboard')
@section('title','Available Jobs')

@section('content')
@foreach($jobs as $job)
<div class="bg-white p-4 shadow rounded mb-4">
    <h3 class="font-bold">{{ $job->title }}</h3>
    <p>{{ $job->description }}</p>
    <p class="text-sm text-gray-600">{{ $job->location }}</p>

    <form method="POST" action="{{ route('apply.job',$job) }}">
        @csrf
        <button class="mt-2 bg-blue-600 text-white px-4 py-1 rounded">Apply</button>
    </form>
</div>
@endforeach
@endsection
