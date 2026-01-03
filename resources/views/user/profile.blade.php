@extends('layouts.dashboard')

@section('title', 'Profile Settings')

@section('content')

@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-xl shadow p-6 max-w-lg">
    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Name</label>
            <input type="text" name="name"
                   value="{{ auth()->user()->name }}"
                   class="w-full border rounded p-2">
        </div>

        <div class="mb-4">
            <label class="block mb-1 text-sm font-medium">Email</label>
            <input type="email" name="email"
                   value="{{ auth()->user()->email }}"
                   class="w-full border rounded p-2">
        </div>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Update Profile
        </button>
    </form>
</div>

@endsection
