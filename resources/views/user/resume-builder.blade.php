@extends('layouts.dashboard')

@section('title', 'Resume Builder')

@section('content')

    {{-- Success/Error Messages --}}
    @if (session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    {{-- Main Layout --}}
    <div class="flex flex-col lg:flex-row gap-8 h-[calc(100vh-100px)]">

        {{-- ================= LEFT COLUMN: EDITOR FORM ================= --}}
        {{-- 'no-print' class helps us hide this column quickly in CSS --}}
        <div id="editor-column" class="w-full lg:w-1/2 overflow-y-auto pr-2 custom-scrollbar no-print">

            <form id="resumeForm" method="POST" action="{{ route('user.resume.store') }}" class="space-y-6">
                @csrf

                {{-- 1. Personal Details --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-blue-100 text-blue-600 p-1.5 rounded-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </span>
                        Personal Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Full Name</label>
                            <input type="text" name="full_name" id="inputName" placeholder="John Doe"
                                value="{{ $resume->full_name ?? '' }}"
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase">Job Title</label>
                            <input type="text" name="job_title" id="inputTitle" placeholder="Software Engineer"
                                value="{{ $resume->job_title ?? '' }}"
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase">Email</label>
                            <input type="email" name="email" id="inputEmail" placeholder="john@example.com"
                                value="{{ $resume->email ?? '' }}"
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase">Phone</label>
                            <input type="text" name="phone" id="inputPhone" placeholder="+1 234 567 890"
                                value="{{ $resume->phone ?? '' }}"
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase">Location</label>
                            <input type="text" name="location" id="inputLocation" placeholder="New York, USA"
                                value="{{ $resume->location ?? '' }}"
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                                oninput="updatePreview()">
                        </div>

                        <div class="col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase">Professional Summary</label>
                            <textarea name="summary" id="inputSummary" rows="3" placeholder="Briefly describe your career..."
                                class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" oninput="updatePreview()">{{ $resume->summary ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 2. Experience Section --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                            <span class="bg-purple-100 text-purple-600 p-1.5 rounded-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </span>
                            Experience
                        </h3>
                        <button type="button" onclick="addExperience()"
                            class="text-sm text-blue-600 hover:underline font-medium">+ Add Job</button>
                    </div>

                    <div id="experienceContainer" class="space-y-4">
                        @if (isset($resume) && $resume->experiences->count() > 0)
                            @foreach ($resume->experiences as $index => $exp)
                                <div
                                    class="experience-item bg-gray-50 p-4 rounded-lg border border-gray-200 relative group">
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="text" name="experiences[{{ $index }}][role]"
                                            value="{{ $exp->role }}" placeholder="Job Title"
                                            class="exp-role w-full p-2 text-sm border rounded" oninput="updatePreview()">
                                        <input type="text" name="experiences[{{ $index }}][company]"
                                            value="{{ $exp->company }}" placeholder="Company"
                                            class="exp-company w-full p-2 text-sm border rounded" oninput="updatePreview()">
                                        <input type="text" name="experiences[{{ $index }}][date_range]"
                                            value="{{ $exp->date_range }}" placeholder="Date Range"
                                            class="exp-date w-full p-2 text-sm border rounded col-span-2"
                                            oninput="updatePreview()">
                                        <textarea name="experiences[{{ $index }}][description]" placeholder="Description"
                                            class="exp-desc w-full p-2 text-sm border rounded col-span-2" rows="2" oninput="updatePreview()">{{ $exp->description }}</textarea>
                                    </div>
                                    <button type="button" onclick="this.parentElement.remove(); updatePreview()"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 text-xs">✕</button>
                                </div>
                            @endforeach
                        @else
                            <div class="experience-item bg-gray-50 p-4 rounded-lg border border-gray-200 relative group">
                                <div class="grid grid-cols-2 gap-3">
                                    <input type="text" name="experiences[0][role]" placeholder="Job Title"
                                        class="exp-role w-full p-2 text-sm border rounded" oninput="updatePreview()">
                                    <input type="text" name="experiences[0][company]" placeholder="Company"
                                        class="exp-company w-full p-2 text-sm border rounded" oninput="updatePreview()">
                                    <input type="text" name="experiences[0][date_range]"
                                        placeholder="Date Range (e.g. 2020 - Present)"
                                        class="exp-date w-full p-2 text-sm border rounded col-span-2"
                                        oninput="updatePreview()">
                                    <textarea name="experiences[0][description]" placeholder="Job Description / Achievements"
                                        class="exp-desc w-full p-2 text-sm border rounded col-span-2" rows="2" oninput="updatePreview()"></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- 3. Skills Section --}}
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <span class="bg-green-100 text-green-600 p-1.5 rounded-md">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </span>
                        Skills
                    </h3>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase">List your skills (comma
                            separated)</label>
                        <input type="text" name="skills" id="inputSkills"
                            placeholder="PHP, Laravel, Tailwind CSS, SQL" value="{{ $resume->skills ?? '' }}"
                            class="w-full mt-1 p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none"
                            oninput="updatePreview()">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4 pb-8">
                    {{-- onclick="window.print()" calls the browser print dialog --}}
                    <button type="button" onclick="window.print()"
                        class="flex-1 bg-gray-900 text-white py-3 rounded-lg font-semibold hover:bg-gray-800 transition shadow-lg">
                        Download / Print PDF
                    </button>
                    <button type="submit"
                        class="flex-1 bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition shadow-lg">
                        Save Resume
                    </button>
                </div>

            </form>
        </div>

        {{-- ================= RIGHT COLUMN: LIVE PREVIEW (A4) ================= --}}
        <div class="hidden lg:block w-1/2 bg-gray-200 overflow-y-auto p-4 rounded-xl custom-scrollbar flex justify-center">

            {{-- A4 Paper --}}
            <div id="resumePreview"
                class="bg-white shadow-2xl w-[210mm] min-h-[297mm] p-10 box-border text-gray-800 transform origin-top scale-[0.85]">

                {{-- Header --}}
                <div class="border-b-2 border-gray-800 pb-6 mb-6">
                    <h1 id="previewName" class="text-4xl font-bold uppercase tracking-wide text-gray-900">Your Name</h1>
                    <p id="previewTitle" class="text-xl text-blue-600 font-medium mt-1">Job Title</p>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-500 mt-4">
                        <span id="previewEmail" class="flex items-center gap-1">email@example.com</span>
                        <span class="text-gray-300">|</span>
                        <span id="previewPhone" class="flex items-center gap-1">+1 234 567 890</span>
                        <span class="text-gray-300">|</span>
                        <span id="previewLocation" class="flex items-center gap-1">Location</span>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-3 border-b pb-1">Profile</h2>
                    <p id="previewSummary" class="text-sm leading-relaxed text-gray-700">
                        Your professional summary will appear here.
                    </p>
                </div>

                {{-- Experience --}}
                <div class="mb-8">
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4 border-b pb-1">Experience
                    </h2>
                    <div id="previewExperienceContainer" class="space-y-5">
                        {{-- Dynamic Content --}}
                    </div>
                </div>

                {{-- Skills --}}
                <div>
                    <h2 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4 border-b pb-1">Skills</h2>
                    <div id="previewSkills" class="flex flex-wrap gap-2">
                        {{-- Dynamic Content --}}
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- CSS for Print & Scrollbar --}}
    <style>
        /* Custom Scrollbar for the editor */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        @media print {

            /* 1. GLOBAL RESET: Force body to lose its "screen" height & ensure colors print */
            html,
            body {
                height: auto !important;
                min-height: 0 !important;
                overflow: visible !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                /* Prints background colors */
                print-color-adjust: exact !important;
            }

            /* 2. HIDE EVERYTHING ELSE (Sidebar, Editor, Buttons) */
            body * {
                visibility: hidden;
            }

            /* 3. VISIBILITY FOR RESUME */
            #resumePreview,
            #resumePreview * {
                visibility: visible;
            }

            /* 4. POSITIONING & SIZING */
            #resumePreview {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;

                /* CRITICAL: Reset height so it doesn't force extra pages */
                height: auto !important;
                min-height: auto !important;

                /* Margins: 2cm is standard A4 "Word" style */
                padding: 2cm !important;
                margin: 0 !important;

                /* Visual Cleanup */
                background: white;
                box-shadow: none !important;
                transform: none !important;
                border: none !important;
            }

            /* 5. AVOID BREAKING ELEMENTS ACROSS PAGES */
            h1,
            h2,
            h3,
            p,
            li,
            .experience-item {
                page-break-inside: avoid;
            }

            @page {
                size: A4;
                margin: 0;
                /* We handle margins via padding on #resumePreview */
            }
        }
    </style>

    {{-- JS for Live Update --}}
    <script>
        // Start counting from existing + 10 to avoid ID conflicts
        let experienceCount = {{ isset($resume) ? $resume->experiences->count() + 10 : 10 }};

        document.addEventListener("DOMContentLoaded", function() {
            // This runs ONCE when the page loads to sync DB data to Preview
            updatePreview();
        });

        function updatePreview() {
            // 1. Personal Info
            const name = document.getElementById('inputName').value;
            const title = document.getElementById('inputTitle').value;
            const email = document.getElementById('inputEmail').value;
            const phone = document.getElementById('inputPhone').value;
            const location = document.getElementById('inputLocation').value;
            const summary = document.getElementById('inputSummary').value;

            document.getElementById('previewName').innerText = name || 'YOUR NAME';
            document.getElementById('previewTitle').innerText = title || 'Job Title';
            document.getElementById('previewEmail').innerText = email || 'email@example.com';
            document.getElementById('previewPhone').innerText = phone || 'Phone';
            document.getElementById('previewLocation').innerText = location || 'Location';
            document.getElementById('previewSummary').innerText = summary || 'Summary...';

            // 2. Skills
            const skillsInput = document.getElementById('inputSkills').value;
            const skillsContainer = document.getElementById('previewSkills');
            skillsContainer.innerHTML = '';

            if (skillsInput) {
                const skills = skillsInput.split(',');
                skills.forEach(skill => {
                    if (skill.trim()) {
                        skillsContainer.innerHTML +=
                            `<span class="bg-gray-100 px-3 py-1 rounded text-sm font-medium text-gray-700">${skill.trim()}</span>`;
                    }
                });
            }

            // 3. Experience
            const expContainer = document.getElementById('experienceContainer');
            const previewExpContainer = document.getElementById('previewExperienceContainer');
            previewExpContainer.innerHTML = ''; // Clear current preview

            const items = expContainer.getElementsByClassName('experience-item');

            // Loop through the input forms in the left column
            for (let item of items) {
                const role = item.querySelector('.exp-role')?.value;
                const company = item.querySelector('.exp-company')?.value;
                const date = item.querySelector('.exp-date')?.value;
                const desc = item.querySelector('.exp-desc')?.value;

                if (role || company || desc) {
                    previewExpContainer.innerHTML += `
                    <div>
                        <div class="flex justify-between items-baseline">
                            <h3 class="font-bold text-gray-800 text-lg">${role || 'Job Role'}</h3>
                            <span class="text-sm text-gray-500 font-mono">${date || ''}</span>
                        </div>
                        <p class="text-blue-600 font-medium text-sm mb-2">${company || ''}</p>
                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">${desc || ''}</p>
                    </div>
                `;
                }
            }
        }

        function addExperience() {
            const container = document.getElementById('experienceContainer');
            const newItem = document.createElement('div');
            newItem.className = 'experience-item bg-gray-50 p-4 rounded-lg border border-gray-200 relative group mt-4';

            newItem.innerHTML = `
            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="experiences[${experienceCount}][role]" placeholder="Job Title" class="exp-role w-full p-2 text-sm border rounded" oninput="updatePreview()">
                <input type="text" name="experiences[${experienceCount}][company]" placeholder="Company" class="exp-company w-full p-2 text-sm border rounded" oninput="updatePreview()">
                <input type="text" name="experiences[${experienceCount}][date_range]" placeholder="Date Range" class="exp-date w-full p-2 text-sm border rounded col-span-2" oninput="updatePreview()">
                <textarea name="experiences[${experienceCount}][description]" placeholder="Description" class="exp-desc w-full p-2 text-sm border rounded col-span-2" rows="2" oninput="updatePreview()"></textarea>
            </div>
            <button type="button" onclick="this.parentElement.remove(); updatePreview()" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow hover:bg-red-600 text-xs">✕</button>
        `;
            container.appendChild(newItem);
            experienceCount++;
        }
    </script>

@endsection
