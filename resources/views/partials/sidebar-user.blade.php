<aside class="w-64 bg-slate-900 text-gray-100 min-h-screen flex flex-col">

    {{-- Logo --}}
    <div class="flex items-center gap-3 px-6 py-5 border-b border-slate-700">
        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-600 font-bold">
            ER
        </div>
        <span class="text-lg font-semibold">e-Recruitment</span>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1">

        {{-- Dashboard --}}
        <a href="{{ route('user.dashboard') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
            {{-- Icon --}}
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5"/>
            </svg>
            Dashboard
        </a>

        {{-- Available Jobs --}}
        <a href="{{ route('user.jobs') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
            </svg>
            Available Jobs
        </a>

        {{-- My Applications --}}
        <a href="{{ route('user.applications') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M8 7h8M8 11h8M8 15h8M4 6h16v12H4z"/>
            </svg>
            My Applications
        </a>

        {{-- Profile --}}
        <a href="{{ route('user.profile') }}"
           class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-slate-700 transition">
            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.75 7.5a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z"/>
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 20.25a7.5 7.5 0 0115 0"/>
            </svg>
            Profile Settings
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
