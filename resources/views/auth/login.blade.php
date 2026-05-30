<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In — e-Recruitment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 antialiased min-h-screen flex flex-col">

    {{-- Navbar --}}
    <nav class="bg-white border-b border-gray-100 px-6 py-4 flex items-center justify-between sticky top-0 z-50 shadow-sm">
        <a href="/" class="flex items-center gap-2.5">
            <div class="w-9 h-9 bg-indigo-600 text-white rounded-xl flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16 7V6a4 4 0 00-8 0v1M4 7h16M6 7v10a3 3 0 003 3h6a3 3 0 003-3V7"/>
                </svg>
            </div>
            <span class="text-lg font-bold text-gray-900 tracking-tight">e-Recruitment</span>
        </a>
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-500 hidden sm:block">Don't have an account?</span>
            <a href="{{ route('register') }}"
               class="px-4 py-2 text-sm font-semibold text-indigo-600 border border-indigo-200 bg-white hover:bg-indigo-50 rounded-lg transition shadow-sm">
                Register
            </a>
        </div>
    </nav>

    {{-- Main --}}
    <div class="flex-grow flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">

            {{-- Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">

                {{-- Header --}}
                <div class="text-center mb-8">
                    <div class="w-14 h-14 bg-indigo-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Welcome back</h1>
                    <p class="text-sm text-gray-500 mt-1">Sign in to your account to continue</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">
                            Email Address
                        </label>
                        <x-text-input
                            id="email"
                            name="email"
                            type="email"
                            :value="old('email')"
                            required autofocus autocomplete="username"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="you@example.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}"
                                   class="text-xs font-semibold text-indigo-600 hover:text-indigo-700 hover:underline">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                        <x-text-input
                            id="password"
                            name="password"
                            type="password"
                            required autocomplete="current-password"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="••••••••"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    {{-- Remember Me --}}
                    <div class="flex items-center gap-2">
                        <input id="remember_me" type="checkbox" name="remember"
                               class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                        <label for="remember_me" class="text-sm text-gray-600 select-none">Remember me</label>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-sm shadow-indigo-500/30 transition-all hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Sign In
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="font-semibold text-indigo-600 hover:underline">Create one</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
