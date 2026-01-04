@extends('layouts.dashboard')

@section('title', 'Profile Settings')

@section('content')

{{-- Success Message --}}
@if(session('success'))
    <div class="mb-4 bg-green-100 text-green-800 p-3 rounded">
        {{ session('success') }}
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- ================= PROFILE INFO ================= --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">
            Profile Information
        </h2>

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

            <button
                class="bg-indigo-600 text-white px-4 py-2 rounded
                       hover:bg-indigo-700 transition">
                Update Profile
            </button>
        </form>
    </div>

    {{-- ================= CHANGE PASSWORD ================= --}}
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-lg font-semibold mb-4">
            Change Password
        </h2>

        <form method="POST" action="{{ route('user.change.password') }}">
            @csrf

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">
                    Current Password
                </label>
                <input type="password" name="current_password"
                       class="w-full border rounded p-2">
                @error('current_password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">
                    New Password
                </label>
                <input type="password" name="new_password"
                       class="w-full border rounded p-2">
                @error('new_password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1 text-sm font-medium">
                    Confirm New Password
                </label>
                <input type="password"
                       name="new_password_confirmation"
                       class="w-full border rounded p-2">
            </div>

            <button
                class="bg-red-600 text-white px-4 py-2 rounded
                       hover:bg-red-700 transition">
                Update Password
            </button>
        </form>
    </div>

</div>

@endsection
