@extends('layouts.dashboard')

@section('title', 'Resume Builder')

@section('content')

    {{-- Main Layout --}}
    <div class="flex flex-col lg:flex-row gap-8 h-[calc(100vh-120px)]">

        {{-- ================= LEFT COLUMN: EDITOR FORM ================= --}}
        <div id="editor-column" class="w-full lg:w-1/2 overflow-y-auto pr-2 custom-scrollbar no-print pb-8">

            <form id="resumeForm" method="POST" action="{{ route('user.resume.store') }}" class="space-y-6">
                @csrf

                {{-- 1. Personal Details --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-base font-bold text-gray-900 mb-5 flex items-center gap-2.5">
                        <span class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                        </span>
                        Personal Details
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Full Name</label>
                            <input type="text" name="full_name" id="inputName" placeholder="John Doe"
                                value="{{ $resume->full_name ?? '' }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Job Title</label>
                            <input type="text" name="job_title" id="inputTitle" placeholder="Software Engineer"
                                value="{{ $resume->job_title ?? '' }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</label>
                            <input type="email" name="email" id="inputEmail" placeholder="john@example.com"
                                value="{{ $resume->email ?? '' }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Phone</label>
                            <input type="text" name="phone" id="inputPhone" placeholder="+1 234 567 890"
                                value="{{ $resume->phone ?? '' }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                                oninput="updatePreview()">
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Location</label>
                            <input type="text" name="location" id="inputLocation" placeholder="Kuala Lumpur, Malaysia"
                                value="{{ $resume->location ?? '' }}"
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                                oninput="updatePreview()">
                        </div>

                        <div class="col-span-2">
                            <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">Professional Summary</label>
                            <textarea name="summary" id="inputSummary" rows="4" placeholder="Briefly describe your career goals and achievements..."
                                class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200" oninput="updatePreview()">{{ $resume->summary ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- 2. Experience Section --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-5">
                        <h3 class="text-base font-bold text-gray-900 flex items-center gap-2.5">
                            <span class="w-8 h-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                <span class="material-symbols-outlined text-[20px]">work</span>
                            </span>
                            Experience
                        </h3>
                        <button type="button" onclick="addExperience()"
                            class="inline-flex items-center gap-1 text-xs font-bold text-indigo-600 hover:text-indigo-700 bg-indigo-50 hover:bg-indigo-100/80 px-2.5 py-1.5 rounded-lg transition">
                            <span class="material-symbols-outlined text-[14px]">add</span> Add Job
                        </button>
                    </div>

                    <div id="experienceContainer" class="space-y-4">
                        @if (isset($resume) && $resume->experiences->count() > 0)
                            @foreach ($resume->experiences as $index => $exp)
                                <div
                                    class="experience-item bg-slate-50/50 p-5 rounded-2xl border border-gray-150 relative group transition-colors hover:bg-slate-50">
                                    <div class="grid grid-cols-2 gap-3">
                                        <input type="text" name="experiences[{{ $index }}][role]"
                                            value="{{ $exp->role }}" placeholder="Job Title / Role"
                                            class="exp-role w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                                        <input type="text" name="experiences[{{ $index }}][company]"
                                            value="{{ $exp->company }}" placeholder="Company Name"
                                            class="exp-company w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                                        <input type="text" name="experiences[{{ $index }}][date_range]"
                                            value="{{ $exp->date_range }}" placeholder="Date Range (e.g., Jan 2021 - Present)"
                                            class="exp-date w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2"
                                            oninput="updatePreview()">
                                        <textarea name="experiences[{{ $index }}][description]" placeholder="Key achievements and daily duties..."
                                            class="exp-desc w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2" rows="3" oninput="updatePreview()">{{ $exp->description }}</textarea>
                                    </div>
                                    <button type="button" onclick="this.parentElement.remove(); updatePreview()"
                                        class="absolute -top-1.5 -right-1.5 bg-white text-red-500 border border-gray-200 rounded-full w-6 h-6 flex items-center justify-center shadow hover:bg-red-50 text-xs transition cursor-pointer">✕</button>
                                </div>
                            @endforeach
                        @else
                            <div class="experience-item bg-slate-50/50 p-5 rounded-2xl border border-gray-150 relative group transition-colors hover:bg-slate-50">
                                <div class="grid grid-cols-2 gap-3">
                                    <input type="text" name="experiences[0][role]" placeholder="Job Title / Role"
                                        class="exp-role w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                                    <input type="text" name="experiences[0][company]" placeholder="Company Name"
                                        class="exp-company w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                                    <input type="text" name="experiences[0][date_range]"
                                        placeholder="Date Range (e.g., Jan 2021 - Present)"
                                        class="exp-date w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2"
                                        oninput="updatePreview()">
                                    <textarea name="experiences[0][description]" placeholder="Key achievements and daily duties..."
                                        class="exp-desc w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2" rows="3" oninput="updatePreview()"></textarea>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- 3. Skills Section --}}
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-base font-bold text-gray-900 mb-5 flex items-center gap-2.5">
                        <span class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-[20px]">bolt</span>
                        </span>
                        Skills
                    </h3>
                    <div>
                        <label class="text-xs font-semibold text-gray-500 uppercase tracking-wider">List your skills (comma separated)</label>
                        <input type="text" name="skills" id="inputSkills"
                            placeholder="PHP, Laravel, Tailwind CSS, SQL" value="{{ $resume->skills ?? '' }}"
                            class="w-full mt-1.5 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-800 placeholder-gray-400 focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all duration-200"
                            oninput="updatePreview()">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-4 pb-8">
                    <button type="button" onclick="window.print()"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-xl shadow transition-all duration-150 cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]">download</span> PDF Export
                    </button>
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-6 py-3.5 bg-gradient-to-r from-indigo-600 to-indigo-500 hover:from-indigo-700 hover:to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/25 transition-all duration-150 cursor-pointer">
                        <span class="material-symbols-outlined text-[20px]">save</span> Save Resume
                    </button>
                </div>

            </form>
        </div>

        {{-- ================= RIGHT COLUMN: LIVE PREVIEW (A4) ================= --}}
        <div class="hidden lg:block w-1/2 bg-slate-200/50 border border-slate-250/60 overflow-y-auto p-4 rounded-2xl custom-scrollbar flex justify-center">

            {{-- A4 Paper Frame --}}
            <div id="resumePreview"
                class="bg-white shadow-xl w-[210mm] min-h-[297mm] p-12 box-border text-gray-800 transform origin-top scale-[0.8]">

                {{-- Header --}}
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <h1 id="previewName" class="text-3xl font-extrabold tracking-tight text-gray-900">Your Name</h1>
                    <p id="previewTitle" class="text-base text-indigo-600 font-bold tracking-wide mt-1 uppercase">Job Title</p>

                    <div class="flex flex-wrap gap-x-4 gap-y-1 text-xs text-gray-500 mt-4 font-medium">
                        <span id="previewEmail" class="flex items-center gap-1">email@example.com</span>
                        <span class="text-gray-300">·</span>
                        <span id="previewPhone" class="flex items-center gap-1">+1 234 567 890</span>
                        <span class="text-gray-300">·</span>
                        <span id="previewLocation" class="flex items-center gap-1">Location</span>
                    </div>
                </div>

                {{-- Summary --}}
                <div class="mb-8">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-3 pb-1 border-b border-indigo-100">Profile</h2>
                    <p id="previewSummary" class="text-xs leading-relaxed text-gray-650">
                        Your professional summary will appear here.
                    </p>
                </div>

                {{-- Experience --}}
                <div class="mb-8">
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-4 pb-1 border-b border-indigo-100">Experience</h2>
                    <div id="previewExperienceContainer" class="space-y-6">
                        {{-- Dynamic Content --}}
                    </div>
                </div>

                {{-- Skills --}}
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-widest text-indigo-600 mb-4 pb-1 border-b border-indigo-100">Skills</h2>
                    <div id="previewSkills" class="flex flex-wrap gap-1.5">
                        {{-- Dynamic Content --}}
                    </div>
                </div>

            </div>
        </div>

    </div>

    {{-- CSS for Print & Scrollbar --}}
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 4px;
        }

        @media print {
            html,
            body {
                height: auto !important;
                min-height: 0 !important;
                overflow: visible !important;
                margin: 0 !important;
                padding: 0 !important;
                background: white !important;
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }

            body * {
                visibility: hidden;
            }

            #resumePreview,
            #resumePreview * {
                visibility: visible;
            }

            #resumePreview {
                position: absolute;
                left: 0;
                top: 0;
                width: 100% !important;
                height: auto !important;
                min-height: auto !important;
                padding: 2cm !important;
                margin: 0 !important;
                background: white;
                box-shadow: none !important;
                transform: none !important;
                border: none !important;
            }

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
            }
        }
    </style>

    {{-- JS for Live Update --}}
    <script>
        let experienceCount = {{ isset($resume) ? $resume->experiences->count() + 10 : 10 }};

        document.addEventListener("DOMContentLoaded", function() {
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
                            `<span class="bg-slate-100 px-2.5 py-1 rounded text-xs font-semibold text-slate-700">${skill.trim()}</span>`;
                    }
                });
            }

            // 3. Experience
            const expContainer = document.getElementById('experienceContainer');
            const previewExpContainer = document.getElementById('previewExperienceContainer');
            previewExpContainer.innerHTML = ''; // Clear current preview

            const items = expContainer.getElementsByClassName('experience-item');

            for (let item of items) {
                const role = item.querySelector('.exp-role')?.value;
                const company = item.querySelector('.exp-company')?.value;
                const date = item.querySelector('.exp-date')?.value;
                const desc = item.querySelector('.exp-desc')?.value;

                if (role || company || desc) {
                    previewExpContainer.innerHTML += `
                    <div>
                        <div class="flex justify-between items-baseline">
                            <h3 class="font-bold text-gray-800 text-sm">${role || 'Job Role'}</h3>
                            <span class="text-xs text-gray-500 font-mono">${date || ''}</span>
                        </div>
                        <p class="text-indigo-650 font-bold text-xs mb-2 uppercase tracking-wide">${company || ''}</p>
                        <p class="text-xs text-gray-600 leading-relaxed whitespace-pre-line">${desc || ''}</p>
                    </div>
                `;
                }
            }
        }

        function addExperience() {
            const container = document.getElementById('experienceContainer');
            const newItem = document.createElement('div');
            newItem.className = 'experience-item bg-slate-50/50 p-5 rounded-2xl border border-gray-150 relative group mt-4 transition-colors hover:bg-slate-50';

            newItem.innerHTML = `
            <div class="grid grid-cols-2 gap-3">
                <input type="text" name="experiences[${experienceCount}][role]" placeholder="Job Title / Role" class="exp-role w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                <input type="text" name="experiences[${experienceCount}][company]" placeholder="Company Name" class="exp-company w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all" oninput="updatePreview()">
                <input type="text" name="experiences[${experienceCount}][date_range]" placeholder="Date Range" class="exp-date w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2" oninput="updatePreview()">
                <textarea name="experiences[${experienceCount}][description]" placeholder="Key achievements and duties" class="exp-desc w-full px-3 py-2 bg-white border border-gray-250 rounded-xl text-xs text-gray-800 focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all col-span-2" rows="3" oninput="updatePreview()"></textarea>
            </div>
            <button type="button" onclick="this.parentElement.remove(); updatePreview()" class="absolute -top-1.5 -right-1.5 bg-white text-red-500 border border-gray-200 rounded-full w-6 h-6 flex items-center justify-center shadow hover:bg-red-50 text-xs transition cursor-pointer">✕</button>
        `;
            container.appendChild(newItem);
            experienceCount++;
        }
    </script>

@endsection

