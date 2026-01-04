<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CareerConnect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined">

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        /* Smooth fade for job switching */
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        /* Custom Scrollbar for the dark sidebar */
        .dark-scroll::-webkit-scrollbar { width: 6px; }
        .dark-scroll::-webkit-scrollbar-track { background: #1e293b; }
        .dark-scroll::-webkit-scrollbar-thumb { background: #475569; border-radius: 10px; }
        .dark-scroll::-webkit-scrollbar-thumb:hover { background: #64748b; }
    </style>
</head>
<body class="bg-gray-100 h-screen flex flex-col overflow-hidden">

    <nav class="bg-slate-900 border-b border-slate-800 h-16 flex-none z-50">
        <div class="container mx-auto px-6 h-full flex justify-between items-center max-w-7xl">
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="bg-blue-600 p-1.5 rounded-lg group-hover:bg-blue-500 transition">
                    <span class="material-symbols-outlined text-white text-[20px]">hub</span> </div>
                <span class="text-xl font-bold text-white tracking-tight">CareerConnect</span>
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <span class="text-slate-400 text-sm hidden md:inline">Welcome, {{ $userName }}</span>
                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-lg shadow-blue-900/50">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-slate-300 hover:text-white text-sm font-medium transition">Login</a>
                    <a href="{{ route('register') }}" class="bg-white text-slate-900 hover:bg-slate-100 px-4 py-2 rounded-lg text-sm font-medium transition">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <div class="flex flex-1 overflow-hidden">
        
        <aside class="w-80 bg-slate-900 border-r border-slate-800 flex flex-col shrink-0 z-40 shadow-2xl">
            <div class="p-6 border-b border-slate-800 bg-slate-900/50 backdrop-blur-sm sticky top-0">
                <h2 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-4">Find your role</h2>
                
                <form action="{{ route('home') }}" method="GET" class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-2.5 text-slate-500 text-[18px]">search</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Search jobs..." 
                           class="w-full bg-slate-800 text-slate-200 text-sm rounded-lg pl-9 pr-3 py-2 border border-slate-700 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 outline-none transition placeholder-slate-500">
                </form>
            </div>

            <div class="flex-1 overflow-y-auto dark-scroll p-3 space-y-1">
                <div class="text-xs font-bold text-slate-500 uppercase tracking-wider px-3 py-2 mt-2">Available Positions ({{ $jobs->count() }})</div>
                
                @forelse($jobs as $job)
                    <button onclick="showJobDetails({{ $job->id }})" 
                            class="w-full text-left p-3 rounded-lg group transition-all duration-200 border border-transparent hover:bg-slate-800 hover:border-slate-700 focus:bg-blue-900/20 focus:border-blue-500/50 relative overflow-hidden">
                        
                        <div class="relative z-10">
                            <h3 class="font-semibold text-slate-200 text-sm group-hover:text-white transition-colors truncate">{{ $job->title }}</h3>
                            <div class="flex items-center text-xs text-slate-500 mt-1 group-hover:text-slate-400">
                                <span class="material-symbols-outlined text-[14px] mr-1">location_on</span>
                                {{ $job->location }}
                            </div>
                        </div>
                        
                        <div class="absolute right-0 top-0 bottom-0 w-1 bg-blue-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </button>
                @empty
                    <div class="text-center py-8 px-4">
                        <div class="bg-slate-800 rounded-full w-12 h-12 flex items-center justify-center mx-auto mb-3">
                            <span class="material-symbols-outlined text-slate-500">search_off</span>
                        </div>
                        <p class="text-slate-400 text-sm">No jobs found.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="p-4 border-t border-slate-800 text-center">
                <p class="text-xs text-slate-600">&copy; {{ date('Y') }} CareerConnect</p>
            </div>
        </aside>

        <main class="flex-1 bg-gray-50 overflow-y-auto p-4 md:p-8 relative scroll-smooth">
            
            <div class="absolute top-0 left-0 w-full h-64 bg-gradient-to-b from-blue-900/5 to-transparent pointer-events-none"></div>

            <div id="job-container" class="max-w-4xl mx-auto relative z-10">
                
                <div id="empty-state" class="hidden h-[80vh] flex flex-col items-center justify-center text-center space-y-4">
                     <div class="bg-white p-4 rounded-full shadow-sm mb-2">
                        <span class="material-symbols-outlined text-4xl text-blue-600">touch_app</span>
                     </div>
                     <h2 class="text-2xl font-bold text-slate-800">Select a job to view details</h2>
                     <p class="text-slate-500 max-w-sm">Browse the list on the left sidebar to find your next opportunity.</p>
                </div>

                @foreach($jobs as $job)
                    <div id="job-details-{{ $job->id }}" class="fade-in hidden">
                        
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 mb-6 relative overflow-hidden">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>

                            <div class="relative z-10">
                                <div class="flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div>
                                        <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 mb-3">
                                            New Opening
                                        </div>
                                        <h1 class="text-3xl font-bold text-slate-900 tracking-tight">{{ $job->title }}</h1>
                                        <div class="flex items-center text-slate-500 mt-2 text-sm font-medium">
                                            <span class="material-symbols-outlined text-[18px] mr-1">location_on</span>
                                            {{ $job->location }}
                                            <span class="mx-2 text-slate-300">|</span>
                                            <span class="material-symbols-outlined text-[18px] mr-1">schedule</span>
                                            Posted {{ \Carbon\Carbon::parse($job->created_at)->diffForHumans() }}
                                        </div>
                                    </div>

                                    @auth
                                        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold shadow-lg shadow-blue-200 transition transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2">
                                            <span>Apply Now</span>
                                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                                        </button>
                                    @else
                                        <a href="{{ route('login') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-8 py-3 rounded-xl font-semibold shadow-lg shadow-slate-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                                            <span class="material-symbols-outlined text-[18px]">lock</span>
                                            <span>Login to Apply</span>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>

                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                                <span class="bg-blue-100 text-blue-600 p-1 rounded">
                                    <span class="material-symbols-outlined text-[20px]">description</span>
                                </span>
                                Job Description
                            </h3>
                            
                            <div class="prose prose-slate max-w-none text-slate-600 leading-relaxed whitespace-pre-line">
                                {{ $job->description }}
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

        </main>
    </div>

    <script>
        function showJobDetails(id) {
            document.querySelectorAll('[id^="job-details-"]').forEach(el => el.classList.add('hidden'));
            document.getElementById('empty-state').classList.add('hidden');
            const selected = document.getElementById('job-details-' + id);
            if(selected) {
                selected.classList.remove('hidden');
                if(window.innerWidth < 768) selected.scrollIntoView({ behavior: 'smooth' });
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const firstJob = document.querySelector('[id^="job-details-"]');
            if(firstJob) {
                firstJob.classList.remove('hidden');
            } else {
                document.getElementById('empty-state').classList.remove('hidden');
            }
        });
    </script>
</body>
</html>