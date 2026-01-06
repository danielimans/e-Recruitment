<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-Recruitment</title>

    {{-- Tailwind CSS & JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    {{-- Navigation Bar --}}
    <nav
        class="flex items-center justify-between px-6 py-4 bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        {{-- Brand --}}
        <div class="flex items-center gap-2">
            <div class="bg-indigo-600 text-white p-2 rounded-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                    </path>
                </svg>
            </div>
            <span class="text-xl font-bold text-gray-900 tracking-tight">e-Recruitment</span>
        </div>

        {{-- Login / Register Buttons --}}
        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    {{-- If logged in, show Dashboard link --}}
                    <a href="{{ route('dashboard') }}" class="font-semibold text-gray-600 hover:text-indigo-600 transition">
                        Dashboard
                    </a>
                @else
                    {{-- If NOT logged in, show Login & Register --}}
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-indigo-600 transition">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-5 py-2.5 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition shadow-md">
                            Register
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    {{-- Hero Content --}}
    <div class="max-w-6xl mx-auto px-6 py-20 flex flex-col lg:flex-row items-center gap-12">
        {{-- Left Text --}}
        <div class="lg:w-1/2 space-y-6">
            <h1 class="text-5xl font-extrabold text-gray-900 leading-tight">
                Your Future Career <br> <span class="text-indigo-600">Starts Here.</span>
            </h1>
            <p class="text-lg text-gray-600">
                Join thousands of professionals finding their dream jobs. Build your resume, apply with one click, and
                get hired.
            </p>
            <div class="pt-2">
                <a href="{{ route('register') }}"
                    class="inline-block px-8 py-3 bg-indigo-600 text-white text-lg font-semibold rounded-xl shadow-lg hover:bg-indigo-700 transition transform hover:-translate-y-1">
                    Get Started Now
                </a>
            </div>
        </div>

        {{-- Right Illustration (Placeholder) --}}
        <div class="lg:w-1/2 flex justify-center">
            <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-xl border border-gray-100">
                <div class="space-y-4">
                    {{-- Skeleton lines representing a resume/job card --}}
                    <div class="h-4 bg-gray-200 rounded w-3/4"></div>
                    <div class="h-4 bg-gray-200 rounded w-1/2"></div>
                    <div
                        class="h-32 bg-indigo-50 rounded-xl w-full mt-6 flex items-center justify-center text-indigo-200">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0 1 1 0 002 0zM8 8a1 1 0 11-2 0 1 1 0 012 0zm5 11a1 1 0 100-2 1 1 0 000 2zm2-3a1 1 0 11-2 0 1 1 0 012 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Testimonials Section --}}
    <div class="bg-white py-20 border-t border-gray-100">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">Success Stories</h2>
                <p class="text-gray-500 mt-2">See how e-Recruitment helped others land their dream jobs.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Testimonial 1 --}}
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    {{-- Stars --}}
                    <div class="flex text-yellow-400 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-6 italic">"I created my resume using the builder in 10 minutes. Applied
                        to 3 jobs and got hired by a top tech company within a week!"</p>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-lg">
                            SJ</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Sarah Jenkins</h4>
                            <p class="text-sm text-gray-500">Software Engineer</p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 2 --}}
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    {{-- Stars --}}
                    <div class="flex text-yellow-400 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-6 italic">"The application tracking system is a lifesaver. I never had to
                        wonder where I stood in the hiring process. Highly recommended."</p>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center text-purple-600 font-bold text-lg">
                            MR</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Michael Ross</h4>
                            <p class="text-sm text-gray-500">Marketing Manager</p>
                        </div>
                    </div>
                </div>

                {{-- Testimonial 3 --}}
                <div class="bg-gray-50 p-8 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition">
                    {{-- Stars --}}
                    <div class="flex text-yellow-400 mb-4">
                        @for ($i = 0; $i < 5; $i++)
                            <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endfor
                    </div>
                    <p class="text-gray-600 mb-6 italic">"As a fresh graduate, I struggled to find openings. This
                        platform connected me with employers looking exactly for my skill set."</p>
                    <div class="flex items-center gap-4">
                        <div
                            class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center text-green-600 font-bold text-lg">
                            AL</div>
                        <div>
                            <h4 class="font-bold text-gray-900">Amanda Lee</h4>
                            <p class="text-sm text-gray-500">Graphic Designer</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
