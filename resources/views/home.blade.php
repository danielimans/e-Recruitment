<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CareerConnect — Find Your Next Role</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Sidebar job item active indicator */
        .job-item.is-active { background: rgba(99, 102, 241, 0.12); border-color: rgba(99, 102, 241, 0.4); }
        .job-item.is-active .job-indicator { opacity: 1; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex flex-col overflow-hidden">

    {{-- Top Navigation --}}
    <nav class="bg-slate-900 border-b border-slate-800 h-16 flex-none z-50 shadow-lg">
        <div class="container mx-auto px-6 h-full flex justify-between items-center max-w-7xl">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 bg-indigo-600 group-hover:bg-indigo-500 rounded-xl flex items-center justify-center transition shadow-lg shadow-indigo-900/50">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 7V6a4 4 0 00-8 0v1M4 7h16M6 7v10a3 3 0 003 3h6a3 3 0 003-3V7"/>
                    </svg>
                </div>
                <span class="text-xl font-bold text-white tracking-tight">CareerConnect</span>
            </a>

            <div class="flex items-center gap-3">
                @auth
                    <span class="text-slate-400 text-sm hidden md:inline">Welcome, <span class="text-white font-medium">{{ $userName }}</span></span>
                    <a href="{{ url('/dashboard') }}"
                       class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl text-sm font-semibold transition shadow-lg shadow-indigo-900/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4.5 10.5V21h15V10.5"/>
                        </svg>
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-slate-300 hover:text-white text-sm font-medium transition">Sign In</a>
                    <a href="{{ route('register') }}"
                       class="bg-white text-slate-900 hover:bg-slate-100 px-4 py-2 rounded-xl text-sm font-semibold transition shadow">
                        Get Started
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">

        {{-- Left Sidebar: Job List --}}
        <aside class="w-80 bg-slate-900 border-r border-slate-800 flex flex-col shrink-0 z-40 shadow-2xl">

            {{-- Search --}}
            <div class="p-5 border-b border-slate-800 sticky top-0 bg-slate-900">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-3">Find Your Role</p>
                <form action="{{ route('home') }}" method="GET" class="relative">
                    <svg class="w-4 h-4 absolute left-3 top-3 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search jobs..."
                           class="w-full bg-slate-800 text-slate-200 text-sm rounded-xl pl-9 pr-3 py-2.5 border border-slate-700
                                  focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 outline-none transition placeholder-slate-500">
                </form>
            </div>

            {{-- Job List --}}
            <div class="flex-1 overflow-y-auto dark-scroll p-3 space-y-1">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider px-3 py-2">
                    {{ $jobs->count() }} {{ Str::plural('Position', $jobs->count()) }} Available
                </div>

                @forelse($jobs as $job)
                    @php $status = $appliedJobs[$job->id] ?? null; @endphp
                    <button onclick="showJobDetails({{ $job->id }})"
                            id="job-btn-{{ $job->id }}"
                            class="job-item w-full text-left p-3 rounded-xl group transition-all duration-200 border border-transparent hover:bg-slate-800 hover:border-slate-700 relative overflow-hidden">
                        <div class="absolute left-0 top-0 bottom-0 w-0.5 bg-indigo-400 job-indicator opacity-0 rounded-r-full transition-opacity"></div>
                        <div class="relative z-10 pl-1">
                            <h3 class="font-semibold text-slate-200 text-sm group-hover:text-white transition-colors truncate">
                                {{ $job->title }}
                            </h3>
                            <div class="flex items-center justify-between mt-1">
                                <span class="text-xs text-slate-500 group-hover:text-slate-400 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $job->location }}
                                </span>
                                @if($status)
                                    <span class="text-[10px] font-semibold px-1.5 py-0.5 rounded-full
                                        {{ $status === 'Approved' ? 'bg-emerald-900/50 text-emerald-400' : ($status === 'Rejected' ? 'bg-red-900/50 text-red-400' : 'bg-amber-900/50 text-amber-400') }}">
                                        {{ $status }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </button>
                @empty
                    <div class="text-center py-10 px-4">
                        <div class="w-12 h-12 bg-slate-800 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-slate-500" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <p class="text-slate-400 text-sm">No jobs found.</p>
                        @if(request('q'))
                            <a href="{{ route('home') }}" class="text-xs text-indigo-400 hover:underline mt-1 inline-block">Clear search</a>
                        @endif
                    </div>
                @endforelse
            </div>

            <div class="p-4 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-600">&copy; {{ date('Y') }} CareerConnect</p>
            </div>
        </aside>

        {{-- Main Content: Job Details --}}
        <main class="flex-1 bg-gray-50 overflow-y-auto relative custom-scrollbar">

            <div class="absolute top-0 left-0 w-full h-48 bg-gradient-to-b from-indigo-900/5 to-transparent pointer-events-none"></div>

            <div id="job-container" class="max-w-4xl mx-auto p-6 md:p-10 relative z-10">

                {{-- Empty State --}}
                <div id="empty-state" class="hidden h-[75vh] flex flex-col items-center justify-center text-center space-y-4">
                    <div class="w-20 h-20 bg-white rounded-3xl shadow-sm flex items-center justify-center mb-2 border border-gray-100">
                        <svg class="w-10 h-10 text-indigo-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 7V6a3 3 0 013-3h6a3 3 0 013 3v1M3 7h18M5 7v11a3 3 0 003 3h8a3 3 0 003-3V7"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-800">Select a position to view details</h2>
                    <p class="text-slate-500 max-w-sm text-sm">Browse the opportunities in the sidebar and click on one to learn more.</p>
                </div>

                {{-- Job Detail Panels --}}
                @foreach($jobs as $job)
                    @php $appStatus = $appliedJobs[$job->id] ?? null; @endphp
                    <div id="job-details-{{ $job->id }}" class="animate-fade-in hidden">

                        {{-- Job Header Card --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-6 overflow-hidden relative">
                            <div class="absolute top-0 right-0 w-40 h-40 bg-indigo-50 rounded-bl-full -mr-10 -mt-10 opacity-60"></div>

                            <div class="relative z-10">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-5">
                                    <div class="flex-1">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-indigo-100 text-indigo-700 mb-4">
                                            Open Position
                                        </span>
                                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight mb-3">{{ $job->title }}</h1>
                                        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                                {{ $job->location }}
                                            </span>
                                            <span class="flex items-center gap-1.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Apply / Status Button --}}
                                    <div class="flex-shrink-0">
                                        @auth
                                            @if($appStatus)
                                                <div class="inline-flex items-center gap-2 px-6 py-3 rounded-xl font-semibold text-sm
                                                    {{ $appStatus === 'Approved' ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' :
                                                       ($appStatus === 'Rejected' ? 'bg-red-50 text-red-700 border border-red-200' :
                                                       'bg-amber-50 text-amber-700 border border-amber-200') }}">
                                                    @if($appStatus === 'Approved')
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                                        Application Approved
                                                    @elseif($appStatus === 'Rejected')
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                                                        Not Selected
                                                    @else
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                                                        Application Sent
                                                    @endif
                                                </div>
                                            @else
                                                <form method="POST" action="{{ route('apply.job', $job->id) }}">
                                                    @csrf
                                                    <button type="submit"
                                                            class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl shadow-lg shadow-indigo-200 transition-all hover:-translate-y-0.5 active:translate-y-0">
                                                        Apply Now
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}"
                                               class="inline-flex items-center gap-2 px-8 py-3 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow-lg shadow-slate-200 transition-all hover:-translate-y-0.5">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                                </svg>
                                                Login to Apply
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Job Description Card --}}
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                            <h3 class="text-base font-bold text-slate-900 mb-5 flex items-center gap-2.5">
                                <span class="w-8 h-8 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </span>
                                Job Description
                            </h3>
                            <div class="text-slate-600 leading-relaxed whitespace-pre-line text-sm">
                                {{ $job->description }}
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>
        </main>
    </div>

    <script>
        let activeJobId = null;

        function showJobDetails(id) {
            // Hide all panels
            document.querySelectorAll('[id^="job-details-"]').forEach(el => el.classList.add('hidden'));
            // Deactivate all sidebar buttons
            document.querySelectorAll('.job-item').forEach(el => el.classList.remove('is-active'));
            document.getElementById('empty-state').classList.add('hidden');

            const panel = document.getElementById('job-details-' + id);
            const btn = document.getElementById('job-btn-' + id);

            if (panel) {
                panel.classList.remove('hidden');
                if (window.innerWidth < 768) {
                    panel.scrollIntoView({ behavior: 'smooth' });
                }
            }
            if (btn) btn.classList.add('is-active');
            activeJobId = id;
        }

        document.addEventListener('DOMContentLoaded', function () {
            const firstBtn = document.querySelector('.job-item');
            if (firstBtn) {
                const id = firstBtn.id.replace('job-btn-', '');
                showJobDetails(parseInt(id));
            } else {
                document.getElementById('empty-state').classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
