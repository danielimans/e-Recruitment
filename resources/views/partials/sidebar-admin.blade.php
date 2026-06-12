<aside class="w-64 bg-slate-950 text-slate-200 min-h-screen flex flex-col border-r border-slate-900">

    {{-- Brand --}}
    <div class="flex items-center gap-3 px-6 py-6 border-b border-slate-900">
        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gradient-to-br from-indigo-600 to-indigo-500 text-white shadow-lg shadow-indigo-500/20">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 7V6a4 4 0 00-8 0v1M4 7h16M6 7v10a3 3 0 003 3h6a3 3 0 003-3V7"/>
            </svg>
        </div>
        <div class="leading-tight">
            <span class="block text-base font-bold text-white tracking-tight">e-Recruitment</span>
            <span class="block text-[10px] text-indigo-400 font-semibold uppercase tracking-wider">Admin Portal</span>
        </div>
    </div>

    {{-- Admin Info --}}
    <div class="px-5 py-4 border-b border-slate-900/60 bg-slate-900/20">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=6366f1&color=fff&bold=true"
                 alt="{{ auth()->user()->name }}"
                 class="w-9 h-9 rounded-xl object-cover ring-2 ring-indigo-500/20 shadow-md">
            <div class="min-w-0 flex-1">
                <p class="text-xs font-bold text-white truncate leading-none">{{ auth()->user()->name }}</p>
                <p class="text-[10px] text-slate-400 font-medium mt-1 uppercase tracking-wider">Administrator</p>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-6 space-y-1">

        <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-4 pb-2">Main Menu</p>

        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.dashboard') ? 'text-indigo-400' : 'text-slate-400' }}"
                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5"/>
            </svg>
            Dashboard
        </a>

        {{-- Manage Jobs --}}
        <a href="{{ route('jobs.index') }}"
           class="sidebar-link {{ request()->routeIs('jobs.*') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('jobs.*') ? 'text-indigo-400' : 'text-slate-400' }}"
                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
            </svg>
            Manage Jobs
        </a>

        {{-- Applications --}}
        <a href="{{ route('admin.applications') }}"
           class="sidebar-link {{ request()->routeIs('admin.applications') ? 'active' : '' }}">
            <svg class="w-5 h-5 {{ request()->routeIs('admin.applications') ? 'text-indigo-400' : 'text-slate-400' }}"
                 fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <span class="flex-1">Applications</span>
            @if(($pendingApplicationsCount ?? 0) > 0)
                <span class="inline-flex items-center justify-center w-5 h-5 text-[10px] font-bold bg-red-500 text-white rounded-full">
                    {{ $pendingApplicationsCount }}
                </span>
            @endif
        </a>

    </nav>

    {{-- Logout --}}
    <div class="px-3 pb-6 border-t border-slate-900 pt-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="sidebar-link w-full text-slate-400 hover:text-red-400 hover:bg-red-500/10 group cursor-pointer">
                <svg class="w-5 h-5 text-slate-500 group-hover:text-red-400 transition-colors"
                     fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15"/>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H9m0 0l3-3m-3 3l3 3"/>
                </svg>
                Sign Out
            </button>
        </form>
    </div>

</aside>
