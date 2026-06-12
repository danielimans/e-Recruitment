<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Account — e-Recruitment</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 antialiased min-h-screen flex flex-col md:flex-row overflow-x-hidden">

    {{-- Left Side: Beautiful dynamic brand panel --}}
    <div class="md:w-1/2 bg-slate-900 relative hidden md:flex flex-col justify-between p-12 overflow-hidden select-none">
        {{-- Background gradients --}}
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900 via-indigo-950 to-slate-950"></div>
        <div class="absolute -top-40 -left-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl animate-pulse-slow"></div>

        <div class="relative z-10">
            <a href="/" class="flex items-center gap-3 group">
                <div class="w-10 h-10 bg-indigo-600 text-white rounded-xl flex items-center justify-center shadow-lg shadow-indigo-500/30 group-hover:scale-105 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7V6a4 4 0 00-8 0v1M4 7h16M6 7v10a3 3 0 003 3h6a3 3 0 003-3V7"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-white tracking-tight">e-Recruitment</span>
            </a>
        </div>

        <div class="relative z-10 my-auto max-w-md space-y-6">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 text-xs font-semibold rounded-full uppercase tracking-wider">
                <span class="w-1.5 h-1.5 bg-indigo-400 rounded-full animate-ping"></span>
                Join the Network
            </span>
            <h2 class="text-4xl lg:text-5xl font-extrabold text-white leading-tight">
                Kickstart your <br/>
                <span class="bg-gradient-to-r from-indigo-400 to-cyan-400 bg-clip-text text-transparent">professional journey.</span>
            </h2>
            <p class="text-slate-400 leading-relaxed">
                Create an account to browse hundreds of jobs, build a responsive digital resume, and submit application profiles to top hiring managers in one click.
            </p>
        </div>

        <div class="relative z-10 text-xs text-slate-500">
            &copy; {{ date('Y') }} e-Recruitment. Professional portal.
        </div>
    </div>

    {{-- Right Side: Centered registration form --}}
    <div class="flex-1 flex flex-col justify-center px-6 py-12 md:px-16 lg:px-24 bg-white relative z-10">
        {{-- Mobile Logo --}}
        <div class="md:hidden flex items-center justify-between mb-12">
            <a href="/" class="flex items-center gap-2.5">
                <div class="w-8 h-8 bg-indigo-600 text-white rounded-lg flex items-center justify-center shadow-md shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7V6a4 4 0 00-8 0v1M4 7h16M6 7v10a3 3 0 003 3h6a3 3 0 003-3V7"/>
                    </svg>
                </div>
                <span class="text-lg font-bold text-gray-900 tracking-tight">e-Recruitment</span>
            </a>
            <a href="{{ route('login') }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-700">Sign In</a>
        </div>

        <div class="w-full max-w-sm mx-auto">
            <div class="mb-8">
                <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Create account</h1>
                <p class="text-sm text-gray-500 mt-2">Get started with your free profile today.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                {{-- Full Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <x-text-input
                        id="name" name="name" type="text"
                        :value="old('name')" required autofocus autocomplete="name"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                        placeholder="John Doe"
                    />
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                {{-- Email Address --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <x-text-input
                        id="email" name="email" type="email"
                        :value="old('email')" required autocomplete="username"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                        placeholder="john@example.com"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                {{-- Register As Role --}}
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Register As</label>
                    <select id="role" name="role"
                            class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200">
                        <option value="user" {{ old('role') !== 'admin' ? 'selected' : '' }}>Job Seeker (User)</option>
                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Employer / Admin</option>
                    </select>
                    <x-input-error :messages="$errors->get('role')" class="mt-1" />
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <x-text-input
                        id="password" name="password" type="password"
                        required autocomplete="new-password"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <x-text-input
                        id="password_confirmation" name="password_confirmation" type="password"
                        required autocomplete="new-password"
                        class="block w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-gray-800 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                        placeholder="••••••••"
                    />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full inline-flex items-center justify-center py-3 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 hover:shadow-xl hover:shadow-indigo-500/30 hover:-translate-y-0.5 active:translate-y-0 focus:outline-none transition-all duration-200 cursor-pointer mt-2">
                    Create Account
                </button>
            </form>

            <div class="text-center mt-6 text-sm text-gray-500 hidden md:block">
                Already have an account?
                <a href="{{ route('login') }}" class="font-semibold text-indigo-600 hover:underline">Sign in</a>
            </div>
        </div>
    </div>

</body>
</html>
