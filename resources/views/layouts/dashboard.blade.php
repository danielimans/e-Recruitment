<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-Recruitment System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">

    {{-- Sidebar --}}
    @if(auth()->user()->role === 'admin')
        @include('partials.sidebar-admin')
    @else
        @include('partials.sidebar-user')
    @endif

    {{-- Content Area --}}
    <div class="flex-1 flex flex-col">

        {{-- Header (NEW) --}}
        <header class="bg-slate-900 border-b border-slate-700 px-6 py-4">
            <h1 class="text-xl font-semibold text-white">
                @yield('title')
            </h1>
        </header>

        {{-- Main Content --}}
        <main class="flex-1 p-6 bg-gray-100">

            @if(session('success'))
                <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>

</div>

</body>
</html>
