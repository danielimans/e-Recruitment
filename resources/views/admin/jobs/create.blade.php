@extends('layouts.dashboard')
@section('title','Job Form')

@section('content')
<form method="POST" action="{{ isset($job) ? route('jobs.update',$job) : route('jobs.store') }}">
    @csrf
    @isset($job) @method('PUT') @endisset

    <input name="title" value="{{ $job->title ?? '' }}" placeholder="Job Title" class="w-full p-2 border mb-3">
    <textarea name="description" class="w-full p-2 border mb-3">{{ $job->description ?? '' }}</textarea>
    <input name="location" value="{{ $job->location ?? '' }}" placeholder="Location" class="w-full p-2 border mb-3">

    <button class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
</form>
@endsection
