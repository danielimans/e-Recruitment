<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password - e-Recruitment</title>

    {{-- Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans min-h-screen flex flex-col">

    {{-- 1. Navigation Bar --}}
    <nav
        class="flex items-center justify-between px-6 py-4 bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <a href="/" class="flex items-center gap-2">
            <div class="bg-indigo-600 text-white p-2 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-900 tracking-tight">e-Recruitment</span>
        </a>

        <div class="flex items-center gap-4">
            <a href="{{ route('login') }}"
                class="px-5 py-2.5 bg-white text-indigo-600 border border-indigo-200 rounded-lg hover:bg-indigo-50 font-medium transition shadow-sm">
                Back to Login
            </a>
        </div>
    </nav>

    {{-- 2. Main Content --}}
    <div class="flex-grow flex items-center justify-center p-6">

        {{-- CARD: Gray Background (bg-gray-200) --}}
        <div class="w-full max-w-md bg-gray-200 p-8 rounded-2xl shadow-xl border border-gray-300">

            {{-- Header --}}
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-extrabold text-gray-900">Forgot Password?</h2>
            </div>

            <div class="mb-6 text-sm text-gray-700 font-medium leading-relaxed">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    {{-- LABEL: Black & Bold --}}
                    <label for="email" class="block font-bold text-sm text-gray-900 mb-1">
                        {{ __('Email') }}
                    </label>

                    {{-- INPUT: Dark Navy (bg-slate-900) + White Text --}}
                    <x-text-input id="email"
                        class="block mt-1 w-full bg-slate-900 border-transparent text-white placeholder-gray-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500 rounded-lg shadow-sm"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-8">
                    <button type="submit"
                        class="w-full justify-center px-6 py-3 bg-indigo-600 text-white text-base font-bold rounded-xl shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Email Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
