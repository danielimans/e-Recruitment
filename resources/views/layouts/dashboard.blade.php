<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-Recruitment System') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script>
document.getElementById('notifBtn')?.addEventListener('click', () => {document.getElementById('notifDropdown')?.classList.toggle('hidden');});
</script>
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
        <header class="bg-slate-900 text-white px-6 py-4 flex items-center justify-between">

            {{-- Page Title --}}
            <h1 class="text-lg font-semibold">
                @yield('title')
            </h1>

            {{-- Notification Bell --}}
            @if(auth()->user()->role === 'user')
                <div class="relative">

                    <button id="notifBtn" class="relative text-xl">
                        🔔
                        @if(isset($headerNotifications) && $headerNotifications->count() > 0)
                            <span
                                class="absolute -top-2 -right-2 bg-red-600 text-white
                                    text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                {{ $headerNotifications->count() }}
                            </span>
                        @endif
                    </button>

                    {{-- Dropdown --}}
                    <div id="notifDropdown"
                        class="hidden absolute right-0 mt-2 w-80 bg-white text-gray-800
                                shadow-lg rounded-lg z-50">

                        <div class="p-3 border-b font-semibold">
                            Notifications
                        </div>

                        <ul class="max-h-64 overflow-y-auto">
                            @forelse($headerNotifications ?? [] as $note)
                                <li class="p-3 border-b text-sm">
                                    <span class="font-semibold">{{ $note->job->title }}</span>
                                    was
                                    <span class="{{ $note->status === 'Approved'
                                        ? 'text-green-600'
                                        : 'text-red-600' }}">
                                        {{ $note->status }}
                                    </span>
                                    <div class="text-xs text-gray-500">
                                        {{ $note->updated_at->diffForHumans() }}
                                    </div>
                                </li>
                            @empty
                                <li class="p-3 text-sm text-gray-500">
                                    No notifications yet.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            @endif
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
