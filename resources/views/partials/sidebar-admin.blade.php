<aside class="w-64 bg-slate-900 text-gray-100 min-h-screen flex flex-col">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-700">
        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 font-bold">
            ER
        </div>
        <span class="text-lg font-semibold">Admin Panel</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1">

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-slate-700' : '' }}">

            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5"/>
            </svg>
            Dashboard
        </a>

        {{-- Manage Jobs --}}
        <a href="{{ route('jobs.index') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('jobs.index') ? 'bg-slate-700' : '' }}">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
            </svg>
            Manage Jobs
        </a>

        {{-- Applications --}}
        <a href="{{ route('admin.applications') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg {{ request()->routeIs('admin.applications') ? 'bg-slate-700' : '' }}">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 7h8M8 11h8M8 15h8M4 6h16v12H4z"/>
            </svg>
            Applications
        </a>

    </nav>

    {{-- Logout --}}
    <div class="px-4 py-4 border-t border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full flex items-center gap-3 px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M18 12H9m0 0l3-3m-3 3l3 3"/>
                </svg>
                Logout
            </button>
        </form>
    </div>

</aside>
