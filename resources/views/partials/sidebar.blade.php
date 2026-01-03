<aside class="w-64 bg-slate-900 text-gray-100 min-h-screen flex flex-col">
    
    {{-- Brand --}}
    <div class="px-6 py-5 text-xl font-bold border-b border-slate-700">
        e-Recruitment
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1">
        @if(auth()->check() && auth()->user()->role === 'admin')
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                Dashboard
            </a>

            <a href="{{ route('jobs.index') }}"
               class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                Manage Jobs
            </a>

            <a href="{{ route('admin.applications') }}"
               class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                Applications
            </a>
        @else
            <a href="{{ route('user.dashboard') }}"
               class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                Dashboard
            </a>

            <a href="{{ route('user.jobs') }}"
               class="block px-4 py-2 rounded-lg hover:bg-slate-700 transition">
                Available Jobs
            </a>
        @endif
    </nav>

    {{-- Logout --}}
    <div class="px-4 py-4 border-t border-slate-700">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button
                class="w-full text-left px-4 py-2 rounded-lg bg-red-600 hover:bg-red-700 transition">
                Logout
            </button>
        </form>
    </div>

</aside>
