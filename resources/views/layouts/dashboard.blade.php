<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'e-Recruitment System') }}</title>

    {{-- 1. ADDED: Google Fonts for Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- 2. ADDED: Global Print Styles to fix blank pages --}}
    <style>
        @media print {

            /* Hide sidebar, header, and notifications when printing */
            aside,
            header,
            #notifBtn,
            #notifDropdown {
                display: none !important;
            }

            /* Reset layout so the resume takes full width */
            .flex {
                display: block !important;
            }

            main {
                margin: 0 !important;
                padding: 0 !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @if (auth()->user()->role === 'admin')
            @include('partials.sidebar-admin')
        @else
            @include('partials.sidebar-user')
        @endif

        {{-- Content Area --}}
        <div class="flex-1 flex flex-col">

            {{-- Header --}}
            <header class="bg-slate-900 text-white px-6 py-4 flex items-center justify-between print:hidden">

                <h1 class="text-lg font-semibold">
                    @yield('title')
                </h1>

                @if (auth()->user()->role === 'user')
                    <div class="relative">
                        <button id="notifBtn" class="relative text-xl focus:outline-none">
                            🔔
                            @if (isset($headerNotifications) && $headerNotifications->count() > 0)
                                <span
                                    class="absolute -top-2 -right-2 bg-red-600 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">
                                    {{ $headerNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div id="notifDropdown"
                            class="hidden absolute right-0 mt-2 w-80 bg-white text-gray-800 shadow-lg rounded-lg z-50 border border-gray-200">
                            <div class="p-3 border-b font-semibold bg-gray-50">Notifications</div>
                            <ul class="max-h-64 overflow-y-auto">
                                @forelse($headerNotifications ?? [] as $note)
                                    <li class="p-3 border-b text-sm hover:bg-gray-50">
                                        <span class="font-semibold">{{ $note->job->title }}</span> was
                                        <span
                                            class="{{ $note->status === 'Approved' ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $note->status }}
                                        </span>
                                        <div class="text-xs text-gray-500 mt-1">
                                            {{ $note->updated_at->diffForHumans() }}
                                        </div>
                                    </li>
                                @empty
                                    <li class="p-3 text-sm text-gray-500 text-center">No notifications yet.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                @endif
            </header>

            {{-- Main Content --}}
            <main class="flex-1 p-6 bg-gray-100">
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-800 border border-green-200">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>

            {{-- REMOVED: The misplaced Resume Builder link was deleted from here --}}

        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('notifBtn');
            const dropdown = document.getElementById('notifDropdown');

            if (!btn || !dropdown) return;

            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdown.classList.toggle('hidden');
            });

            dropdown.addEventListener('click', function(e) {
                e.stopPropagation(); // Keep open when clicking inside
            });

            document.addEventListener('click', function() {
                dropdown.classList.add('hidden'); // Close when clicking outside
            });
        });
    </script>
</body>

</html>
