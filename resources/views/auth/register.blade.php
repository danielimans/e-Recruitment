<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — e-Recruitment</title>
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
            <span class="text-sm text-gray-500 hidden sm:block">Already have an account?</span>
            <a href="{{ route('login') }}"
               class="px-4 py-2 text-sm font-semibold text-indigo-600 border border-indigo-200 bg-white hover:bg-indigo-50 rounded-lg transition shadow-sm">
                Sign In
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
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Create an account</h1>
                    <p class="text-sm text-gray-500 mt-1">Join us to find your next opportunity</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Full Name</label>
                        <x-text-input
                            id="name" name="name" type="text"
                            :value="old('name')" required autofocus autocomplete="name"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="Juan dela Cruz"
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email Address</label>
                        <x-text-input
                            id="email" name="email" type="email"
                            :value="old('email')" required autocomplete="username"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="you@example.com"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                    </div>

                    {{-- Role --}}
                    <div>
                        <label for="role" class="block text-sm font-semibold text-gray-700 mb-1.5">Register As</label>
                        <select id="role" name="role"
                                class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                       focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all">
                            <option value="user" {{ old('role') !== 'admin' ? 'selected' : '' }}>Job Seeker (User)</option>
                            <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator</option>
                        </select>
                        <x-input-error :messages="$errors->get('role')" class="mt-1.5" />
                    </div>

                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                        <x-text-input
                            id="password" name="password" type="password"
                            required autocomplete="new-password"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="Min. 8 characters"
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    {{-- Confirm Password --}}
                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Confirm Password</label>
                        <x-text-input
                            id="password_confirmation" name="password_confirmation" type="password"
                            required autocomplete="new-password"
                            class="block w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-gray-800
                                   focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all"
                            placeholder="Repeat your password"
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                            class="w-full py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-sm shadow-indigo-500/30 transition-all hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Create Account
                    </button>
                </form>

                <p class="text-center text-sm text-gray-500 mt-6">
                    Already have an account?
                    <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">Sign in</a>
                </p>
            </div>
        </div>
    </div>

</body>
</html>
