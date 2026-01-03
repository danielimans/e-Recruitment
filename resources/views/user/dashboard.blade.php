@extends('layouts.dashboard')

@section('title', 'User Dashboard')

@section('content')
<p class="text-gray-600">
    Welcome, {{ auth()->user()->name }}.
</p>
@endsection
