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
                        <button id="notifBtn"
                                class="relative w-9 h-9 flex items-center justify-center rounded-xl hover:bg-slate-800 transition focus:outline-none">
                            <svg class="w-5 h-5 text-slate-300" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            @if (isset($headerNotifications) && $headerNotifications->count() > 0)
                                <span class="absolute -top-0.5 -right-0.5 w-4 h-4 bg-red-500 text-white text-[10px] font-bold rounded-full flex items-center justify-center">
                                    {{ $headerNotifications->count() }}
                                </span>
                            @endif
                        </button>

                        <div id="notifDropdown"
                             class="hidden absolute right-0 mt-2 w-80 bg-white text-gray-800 shadow-xl rounded-2xl z-50 border border-gray-100 overflow-hidden">
                            <div class="px-4 py-3 border-b border-gray-100 flex items-center justify-between">
                                <span class="font-bold text-gray-900 text-sm">Notifications</span>
                                @if(isset($headerNotifications) && $headerNotifications->count() > 0)
                                    <span class="text-xs bg-red-100 text-red-600 font-semibold px-2 py-0.5 rounded-full">
                                        {{ $headerNotifications->count() }} new
                                    </span>
                                @endif
                            </div>
                            <ul class="max-h-72 overflow-y-auto">
                                @forelse($headerNotifications ?? [] as $note)
                                    <li class="px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition last:border-0">
                                        <div class="flex items-start gap-3">
                                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5
                                                {{ $note->status === 'Approved' ? 'bg-emerald-100' : 'bg-red-100' }}">
                                                @if($note->status === 'Approved')
                                                    <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                                    </svg>
                                                @else
                                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                @endif
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm text-gray-700 leading-snug">
                                                    Your application for <span class="font-semibold text-gray-900">{{ $note->job->title }}</span> was
                                                    <span class="font-semibold {{ $note->status === 'Approved' ? 'text-emerald-600' : 'text-red-600' }}">{{ $note->status }}</span>
                                                </p>
                                                <p class="text-xs text-gray-400 mt-0.5">{{ $note->updated_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li class="px-4 py-8 text-sm text-gray-400 text-center">
                                        <svg class="w-8 h-8 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                        </svg>
                                        No notifications yet
                                    </li>
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
