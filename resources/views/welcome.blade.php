<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Recruitment — Your Future Career Starts Here</title>
    <meta name="description" content="Find your dream job, build your resume, and apply with one click. Join thousands of professionals on e-Recruitment.">

    {{-- Fonts & Icons --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@300;400;500" />

    {{-- Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-slate-50 text-gray-800 antialiased font-sans">

    {{-- ============================================================
         NAVIGATION
         ============================================================ --}}
    <nav id="mainNav" class="fixed top-0 w-full z-50 transition-all duration-300 bg-white/80 backdrop-blur-xl border-b border-gray-100/50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            {{-- Brand --}}
            <a href="/" class="flex items-center gap-2.5 group">
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-500 text-white p-2 rounded-xl shadow-lg shadow-indigo-500/20 group-hover:shadow-indigo-500/40 transition-all duration-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                </div>
                <span class="text-xl font-bold text-gray-900 tracking-tight">e-Recruitment</span>
            </a>

            {{-- CTA --}}
            <div class="flex items-center gap-3">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-primary text-sm !py-2.5 !px-5">
                            <span class="material-symbols-outlined text-[18px]">dashboard</span>
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-600 hover:text-indigo-600 transition hidden sm:block">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-primary text-sm !py-2.5 !px-5">
                                Get Started
                            </a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    {{-- ============================================================
         HERO SECTION
         ============================================================ --}}
    <section class="relative min-h-[90vh] flex items-center overflow-hidden pt-16">
        {{-- Background Decorations --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-20 left-10 w-72 h-72 bg-indigo-400/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-sky-400/10 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-purple-400/5 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-20 flex flex-col lg:flex-row items-center gap-16 relative z-10">
            {{-- Left Text --}}
            <div class="lg:w-1/2 space-y-8 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 text-indigo-700 text-sm font-semibold rounded-full border border-indigo-100 animate-fade-in-up">
                    <span class="material-symbols-outlined text-[16px]">trending_up</span>
                    Trusted by professionals nationwide
                </div>

                <h1 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight animate-fade-in-up delay-100" style="opacity:0">
                    Your Future Career <br>
                    <span class="gradient-text">Starts Here.</span>
                </h1>

                <p class="text-lg text-gray-500 leading-relaxed max-w-lg mx-auto lg:mx-0 animate-fade-in-up delay-200" style="opacity:0">
                    Build your resume, discover opportunities, and apply with one click.
                    Join thousands of professionals finding their dream jobs.
                </p>

                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start animate-fade-in-up delay-300" style="opacity:0">
                    <a href="{{ route('register') }}" class="btn-primary text-base !px-8 !py-4">
                        <span class="material-symbols-outlined text-[20px]">rocket_launch</span>
                        Get Started Free
                    </a>
                    <a href="#features" class="btn-secondary text-base !px-8 !py-4">
                        Learn More
                        <span class="material-symbols-outlined text-[18px]">arrow_downward</span>
                    </a>
                </div>
            </div>

            {{-- Right: Floating Cards Illustration --}}
            <div class="lg:w-1/2 flex justify-center relative animate-fade-in-up delay-300" style="opacity:0">
                <div class="relative w-full max-w-md">
                    {{-- Main Card --}}
                    <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 p-6 relative z-10">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-500 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-white text-[20px]">work</span>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 text-sm">Senior Software Engineer</h3>
                                <p class="text-xs text-gray-500">Kuala Lumpur · Full-time</p>
                            </div>
                        </div>
                        <div class="space-y-2.5 mb-5">
                            <div class="h-2.5 bg-gray-100 rounded-full w-full"></div>
                            <div class="h-2.5 bg-gray-100 rounded-full w-4/5"></div>
                            <div class="h-2.5 bg-gray-100 rounded-full w-3/5"></div>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-bold text-emerald-600">RM 8,000 - 12,000</span>
                            <span class="bg-indigo-600 text-white text-xs font-bold px-4 py-2 rounded-lg">Apply Now</span>
                        </div>
                    </div>

                    {{-- Floating Card 1 --}}
                    <div class="absolute -top-6 -right-6 bg-white rounded-xl shadow-lg border border-gray-100 px-4 py-3 animate-float z-20">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-emerald-600 text-[16px]">check_circle</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Application Sent!</p>
                                <p class="text-[10px] text-gray-500">Just now</p>
                            </div>
                        </div>
                    </div>

                    {{-- Floating Card 2 --}}
                    <div class="absolute -bottom-4 -left-6 bg-white rounded-xl shadow-lg border border-gray-100 px-4 py-3 animate-float z-20" style="animation-delay: 1.5s">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-indigo-100 rounded-full flex items-center justify-center">
                                <span class="material-symbols-outlined text-indigo-600 text-[16px]">description</span>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-900">Resume Ready</p>
                                <p class="text-[10px] text-gray-500">100% complete</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         STATS BAR
         ============================================================ --}}
    <section class="relative -mt-8 z-20 max-w-5xl mx-auto px-6">
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-8 reveal">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
                <div>
                    <p class="text-3xl font-extrabold gradient-text" data-count="500">0+</p>
                    <p class="text-sm text-gray-500 font-medium mt-1">Active Jobs</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold gradient-text" data-count="1200">0+</p>
                    <p class="text-sm text-gray-500 font-medium mt-1">Registered Users</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold gradient-text" data-count="800">0+</p>
                    <p class="text-sm text-gray-500 font-medium mt-1">Successful Hires</p>
                </div>
                <div>
                    <p class="text-3xl font-extrabold gradient-text" data-count="50">0+</p>
                    <p class="text-sm text-gray-500 font-medium mt-1">Partner Companies</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         HOW IT WORKS
         ============================================================ --}}
    <section id="features" class="py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 text-indigo-700 text-xs font-bold rounded-full uppercase tracking-wider mb-4">How it works</span>
                <h2 class="text-4xl font-extrabold text-gray-900">Three Simple Steps</h2>
                <p class="text-gray-500 mt-3 max-w-md mx-auto">Get started in minutes. No complicated process, just results.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Step 1 --}}
                <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 shadow-sm card-hover reveal">
                    <div class="w-16 h-16 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-indigo-500/20">
                        <span class="material-symbols-outlined text-white text-[28px]">person_add</span>
                    </div>
                    <span class="text-xs font-bold text-indigo-500 uppercase tracking-wider">Step 1</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Create Your Profile</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Sign up and build your professional resume using our smart builder.</p>
                </div>

                {{-- Step 2 --}}
                <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 shadow-sm card-hover reveal" style="transition-delay: 150ms">
                    <div class="w-16 h-16 bg-gradient-to-br from-sky-500 to-sky-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-sky-500/20">
                        <span class="material-symbols-outlined text-white text-[28px]">search</span>
                    </div>
                    <span class="text-xs font-bold text-sky-500 uppercase tracking-wider">Step 2</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Discover Jobs</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Browse curated job listings and find the perfect match for your skills.</p>
                </div>

                {{-- Step 3 --}}
                <div class="text-center p-8 rounded-2xl bg-white border border-gray-100 shadow-sm card-hover reveal" style="transition-delay: 300ms">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-emerald-500/20">
                        <span class="material-symbols-outlined text-white text-[28px]">rocket_launch</span>
                    </div>
                    <span class="text-xs font-bold text-emerald-500 uppercase tracking-wider">Step 3</span>
                    <h3 class="text-xl font-bold text-gray-900 mt-2 mb-3">Apply & Get Hired</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Apply with one click and track your applications in real time.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         TESTIMONIALS
         ============================================================ --}}
    @php
        $testimonials = [
            [
                'name' => 'Nurul Izzah',
                'role' => 'Software Engineer',
                'quote' => 'I created my resume using the builder in 10 minutes. Applied to 3 jobs in Cyberjaya and got hired within a week!',
            ],
            [
                'name' => 'Wong Wei Meng',
                'role' => 'Marketing Manager',
                'quote' => 'The application tracking system is a lifesaver. I never had to wonder where I stood in the hiring process. Highly recommended.',
            ],
            [
                'name' => 'Ravi Chandran',
                'role' => 'Graphic Designer',
                'quote' => 'As a fresh graduate from Penang, I struggled to find openings. This platform connected me with employers looking exactly for my skill set.',
            ],
        ];
    @endphp

    <section class="py-24 px-6 bg-gradient-to-b from-slate-50 to-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 reveal">
                <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-amber-50 text-amber-700 text-xs font-bold rounded-full uppercase tracking-wider mb-4">Testimonials</span>
                <h2 class="text-4xl font-extrabold text-gray-900">Success Stories</h2>
                <p class="text-gray-500 mt-3 max-w-md mx-auto">See how e-Recruitment helped others land their dream jobs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($testimonials as $index => $user)
                    <div class="bg-white p-8 rounded-2xl border border-gray-100 shadow-sm card-hover reveal relative" style="transition-delay: {{ $index * 150 }}ms">
                        {{-- Quote Mark --}}
                        <div class="absolute top-6 right-6 text-4xl text-indigo-100 font-serif leading-none">"</div>

                        {{-- Stars --}}
                        <div class="flex text-amber-400 mb-4 gap-0.5">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <p class="text-gray-600 mb-8 leading-relaxed text-sm relative z-10">"{{ $user['quote'] }}"</p>

                        <div class="flex items-center gap-3">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user['name']) }}&background=6366f1&color=fff&size=128&font-size=0.4&bold=true"
                                alt="{{ $user['name'] }}"
                                class="w-11 h-11 rounded-full object-cover ring-2 ring-white shadow">
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">{{ $user['name'] }}</h4>
                                <p class="text-xs text-gray-500">{{ $user['role'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================================
         CTA SECTION
         ============================================================ --}}
    <section class="py-24 px-6">
        <div class="max-w-4xl mx-auto text-center reveal">
            <div class="bg-gradient-to-br from-indigo-600 via-indigo-600 to-purple-600 rounded-3xl p-12 md:p-16 relative overflow-hidden shadow-2xl shadow-indigo-500/20">
                {{-- Decorative circles --}}
                <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mt-20 -mr-20"></div>
                <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full -mb-16 -ml-16"></div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-extrabold text-white mb-4">Ready to Find Your Dream Job?</h2>
                    <p class="text-indigo-200 text-lg mb-8 max-w-lg mx-auto">Join thousands of professionals who have already taken the first step towards their next career milestone.</p>
                    <a href="{{ route('register') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-indigo-600 font-bold rounded-xl shadow-lg hover:shadow-xl hover:-translate-y-0.5 transition-all duration-200 text-base">
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                        Create Free Account
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================
         FOOTER
         ============================================================ --}}
    <footer class="bg-slate-900 text-slate-400 pt-16 pb-8 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-12">
                {{-- Brand --}}
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2.5 mb-4">
                        <div class="bg-indigo-600 text-white p-2 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">e-Recruitment</span>
                    </div>
                    <p class="text-sm leading-relaxed max-w-sm">Your one-stop platform for finding the perfect career opportunity. Build, apply, and get hired — all in one place.</p>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Platform</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Browse Jobs</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-white transition">Create Account</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-white transition">Resume Builder</a></li>
                    </ul>
                </div>

                {{-- Support --}}
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Support</h4>
                    <ul class="space-y-3 text-sm">
                        <li><a href="#" class="hover:text-white transition">Help Center</a></li>
                        <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition">Terms of Service</a></li>
                    </ul>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="border-t border-slate-800 pt-8 text-center text-xs">
                <p>&copy; {{ date('Y') }} e-Recruitment. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- ============================================================
         SCRIPTS
         ============================================================ --}}
    <script>
        // Intersection Observer for reveal animations
        document.addEventListener('DOMContentLoaded', () => {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

            // Count-up animation for stats
            document.querySelectorAll('[data-count]').forEach(el => {
                const countObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const target = parseInt(entry.target.dataset.count);
                            let current = 0;
                            const step = Math.ceil(target / 40);
                            const timer = setInterval(() => {
                                current += step;
                                if (current >= target) {
                                    current = target;
                                    clearInterval(timer);
                                }
                                entry.target.textContent = current.toLocaleString() + '+';
                            }, 30);
                            countObserver.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                countObserver.observe(el);
            });
        });
    </script>

</body>
</html>
