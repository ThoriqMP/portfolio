@extends('layouts.public')

@section('content')
<!-- Hero / About Section (High-Contrast Structural Brutalist Split) -->
<section id="hero" class="relative py-24 md:py-32 overflow-hidden bg-[#f5f5f5] border-b-8 border-black flex items-center min-h-[80vh]">
    <!-- Brutalist Accent Element (Giant background text) -->
    <div class="absolute right-0 bottom-0 select-none text-[15rem] leading-none font-black text-slate-200/50 uppercase tracking-tighter z-0 pointer-events-none">
        PORTFOLIO
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="lg:grid lg:grid-cols-12 lg:gap-12 items-center">
            <!-- Left Column: Bold Copy & CTA -->
            <div class="sm:text-center md:max-w-2xl md:mx-auto lg:col-span-7 lg:text-left">
                <span class="inline-flex items-center px-4 py-1.5 border-2 border-black text-xs font-black uppercase tracking-widest bg-black text-[#ff5722] shadow-[2px_2px_0px_#ff5722] mb-8">
                    // TERSEDIA UNTUK KERJA
                </span>
                
                <!-- Massive Brutalist Header -->
                <h1 class="text-5xl sm:text-6xl md:text-7xl font-black uppercase tracking-tighter leading-none mb-6">
                    HALO, SAYA <br class="hidden sm:inline">
                    <span class="bg-[#ff5722] text-white px-3 py-1.5 inline-block transform -rotate-1 border-4 border-black shadow-[4px_4px_0px_#000000] tracking-tighter">
                        {{ $user->name }}
                    </span>
                </h1>
                
                <!-- Dynamic Professional Title -->
                @if ($user->title)
                    <p class="text-xl sm:text-2xl font-black uppercase tracking-wide text-black mb-8">
                        // {{ $user->title }}
                    </p>
                @endif
                
                <!-- Structural Bio Card -->
                <div class="border-4 border-black p-6 bg-white shadow-[6px_6px_0px_#000000] mb-8 max-w-2xl">
                    <p class="text-lg md:text-xl font-bold leading-relaxed text-black">
                        {{ $user->bio ?? 'Saya adalah pengembang web profesional yang berfokus membangun pengalaman digital berkinerja tinggi.' }}
                    </p>
                </div>
                
                <!-- Brutalist Action Buttons -->
                <div class="flex flex-wrap gap-4 sm:justify-center lg:justify-start">
                    <a href="#projects" class="brutal-btn inline-flex items-center justify-center px-8 py-4 text-base shadow-[6px_6px_0px_#000000] hover:shadow-[8px_8px_0px_#000000]">
                        Lihat Proyek Saya
                        <svg class="ml-2 -mr-1 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </a>
                    <a href="#timeline" class="inline-flex items-center justify-center px-8 py-4 text-base font-extrabold uppercase tracking-wider text-black bg-white hover:bg-black hover:text-white border-3 border-black shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all duration-100">
                        Hubungi Saya
                    </a>
                </div>
            </div>

            <!-- Right Column: Structural Blocky Graphic Card -->
            <div id="about" class="mt-16 lg:mt-0 lg:col-span-5 flex justify-center">
                <div class="relative w-80 h-80 sm:w-96 sm:h-96 bg-white border-4 border-black p-8 shadow-[10px_10px_0px_#000000] flex flex-col justify-between transform rotate-1 hover:rotate-0 transition duration-200">
                    <!-- Brutalist Grid Overlay -->
                    <div class="absolute inset-0 bg-[linear-gradient(rgba(0,0,0,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(0,0,0,0.03)_1px,transparent_1px)] bg-[size:16px_16px] pointer-events-none"></div>

                    <!-- Decorative Corner Block -->
                    <div class="absolute -top-3 -left-3 w-6 h-6 bg-[#ff5722] border-2 border-black"></div>
                    <div class="absolute -bottom-3 -right-3 w-6 h-6 bg-black border-2 border-[#ff5722]"></div>

                    <!-- Initials Logo Block / Avatar Image -->
                    @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                        <div class="w-32 h-32 bg-white border-4 border-black overflow-hidden shadow-[4px_4px_0px_#000000] mb-6 relative z-10">
                            <img src="{{ asset('storage/' . $user->avatar_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                        </div>
                    @else
                        <div class="w-24 h-24 bg-black border-4 border-black text-[#ff5722] flex items-center justify-center shadow-[4px_4px_0px_#ff5722] mb-6">
                            <span class="text-4xl font-black uppercase tracking-tighter">
                                {{ substr($user->name, 0, 2) }}
                            </span>
                        </div>
                    @endif

                    <!-- User Meta Information -->
                    <div class="space-y-3 z-10 relative mt-auto">
                        <h3 class="text-2xl font-black uppercase tracking-tight text-black">{{ $user->name }}</h3>
                        <p class="text-sm font-extrabold uppercase text-[#ff5722] tracking-wider">{{ $user->title ?? 'Web Developer' }}</p>
                        
                        <div class="flex flex-wrap gap-2 pt-2 text-xxs font-black uppercase">
                            <span class="px-2 py-1 bg-black text-white border border-black">@admin</span>
                            @forelse ($user->badges as $badge)
                                <span class="px-2.5 py-1 border border-black shadow-[1px_1px_0px_#000000] font-black uppercase tracking-wider inline-block"
                                      style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                    {{ $badge->name }}
                                </span>
                            @empty
                                <span class="px-2.5 py-1 bg-[#ff5722] text-black border border-black shadow-[1px_1px_0px_#000000] font-black uppercase tracking-wider inline-block">Laravel 11</span>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Projects Section -->
<section id="projects" class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Title (Brutalist Panel) -->
        <div class="border-4 border-black p-8 bg-black text-white shadow-[6px_6px_0px_#ff5722] max-w-3xl mx-auto mb-20 text-center">
            <h2 class="text-4xl sm:text-5xl font-black uppercase tracking-tighter">
                Portofolio Proyek Terkini
            </h2>
            <p class="text-slate-350 text-sm uppercase tracking-widest mt-3 font-semibold">
                // Koleksi proyek aplikasi web pilihan
            </p>
        </div>

        <!-- Projects Grid of Brutalist Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse ($user->projects as $project)
                <div class="bg-white border-4 border-black rounded-none shadow-[8px_8px_0px_#000000] hover:shadow-[12px_12px_0px_#000000] hover:-translate-x-1 hover:-translate-y-1 transition duration-250 flex flex-col h-full {{ $project->grid_span == 2 ? 'md:col-span-2' : ($project->grid_span == 3 ? 'md:col-span-3' : '') }}">
                    <!-- Image Area with bottom border -->
                    <div class="relative aspect-video overflow-hidden bg-slate-100 border-b-4 border-black">
                        @if($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path))
                            
                            <!-- Widescreen Single Image Preview -->
                            <img src="{{ asset('storage/' . $project->image_path) }}" alt="{{ $project->title }}" class="object-cover w-full h-full">

                        @else
                            <!-- Fallback Brutalist Gradient Grid card -->
                            <div class="w-full h-full bg-[linear-gradient(45deg,#ff5722_25%,transparent_25%),linear-gradient(-45deg,#ff5722_25%,transparent_25%),linear-gradient(45deg,transparent_75%,#ff5722_75%),linear-gradient(-45deg,transparent_75%,#ff5722_75%)] bg-[size:20px_20px] bg-white flex flex-col items-center justify-center p-4">
                                <div class="px-3 py-1 bg-black text-white font-extrabold text-xs uppercase border border-black shadow-[2px_2px_0px_#ff5722] tracking-wider">
                                    Demo Proyek
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Details Area -->
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="text-xl font-black uppercase tracking-tight text-black mb-3">
                            {{ $project->title }}
                        </h3>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed mb-6 flex-grow">
                            {{ $project->description }}
                        </p>

                        <!-- Actions -->
                        <div class="pt-4 border-t-2 border-black flex items-center justify-between mt-auto">
                            <!-- Link to Detail Page -->
                            <a href="{{ route('projects.show', $project->id) }}" class="inline-flex items-center text-xs font-black uppercase tracking-wider text-black border-2 border-black bg-white hover:bg-[#ff5722] px-3.5 py-2.5 shadow-[3px_3px_0px_#000000] active:translate-x-0.5 active:translate-y-0.5 active:shadow-none hover:-translate-y-0.5 hover:-translate-x-0.5 transition-all">
                                Detail Proyek &rarr;
                            </a>
                            
                            @if ($project->project_link)
                                <a href="{{ $project->project_link }}" target="_blank" rel="noopener noreferrer" class="text-xs font-black uppercase tracking-wider text-[#ff5722] hover:text-black flex items-center gap-1">
                                    Link Live
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            @else
                                <span class="text-xxs font-bold text-slate-400 uppercase italic">// Internal</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 border-4 border-dashed border-slate-400">
                    <p class="font-bold text-slate-500 uppercase tracking-wider">Belum ada portofolio proyek yang ditambahkan.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Timeline (Education & Experience) -->
<section id="timeline" class="py-24 bg-[#f5f5f5]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Title (Brutalist Panel) -->
        <div class="border-4 border-black p-8 bg-[#ff5722] text-black shadow-[6px_6px_0px_#000000] max-w-3xl mx-auto mb-20 text-center">
            <h2 class="text-4xl sm:text-5xl font-black uppercase tracking-tighter">
                Pengalaman & Pendidikan
            </h2>
            <p class="text-black text-sm uppercase tracking-widest mt-3 font-extrabold">
                // Jejak Karir Profesional & Akademik
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            <!-- 1. Experience Column -->
            <div>
                <div class="flex items-center gap-3 mb-12">
                    <div class="p-3 bg-black text-[#ff5722] border-2 border-black shadow-[3px_3px_0px_#ff5722]">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 .621-.504 1.125-1.125 1.125H4.875A1.125 1.125 0 013.75 18.4V14.15m16.5 0c0-1.217-.463-2.383-1.29-3.262-.828-.88-1.93-1.388-3.11-1.388H7.9c-1.182 0-2.283.508-3.11 1.388a4.8 4.8 0 00-1.29 3.262m16.5 0a4.8 4.8 0 01-1.29-3.262m-13.92 0a4.8 4.8 0 01-1.29-3.262m13.92 0v-3.13a3 3 0 00-3-3h-2.25a1 1 0 00-1 1v1.3m-5.67 0v-1.3a1 1 0 00-1-1H7.9a3 3 0 00-3 3v3.13m9.9 0H7.9" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black uppercase tracking-tighter">Karir Pekerjaan</h3>
                </div>

                <!-- Brutalist Timeline Path -->
                <div class="relative border-l-4 border-black ml-4 space-y-10">
                    @forelse ($user->experiences as $experience)
                        <div class="relative pl-8">
                            <!-- Bullet Dot Block -->
                            <div class="absolute -left-[14px] top-6 w-5 h-5 bg-[#ff5722] border-3 border-black shadow-[2px_2px_0px_#000000]"></div>
                            
                            <!-- Card Content inside Brutalist Box -->
                            <div class="bg-white border-3 border-black p-6 shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition duration-150">
                                <!-- Period Badge -->
                                <span class="inline-flex items-center px-3 py-1 bg-black text-[#ff5722] border-2 border-black font-extrabold text-xs uppercase shadow-[2px_2px_0px_#ff5722] mb-4">
                                    {{ $experience->start_date->format('M Y') }} - 
                                    {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Sekarang' }}
                                </span>
                                
                                <!-- Position & Company -->
                                <h4 class="text-xl font-black uppercase tracking-tight text-black">{{ $experience->position }}</h4>
                                <span class="text-sm font-extrabold uppercase text-[#ff5722] tracking-wider">{{ $experience->company_name }}</span>
                                
                                <!-- Description -->
                                @if ($experience->description)
                                    @php
                                        $expPoints = json_decode($experience->description, true);
                                    @endphp
                                    @if (is_array($expPoints))
                                        <ul class="list-disc pl-5 mt-4 space-y-1.5 text-sm font-bold text-slate-700 leading-relaxed">
                                            @foreach ($expPoints as $point)
                                                @if (trim($point) !== '')
                                                    <li>{{ $point }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-sm font-bold text-slate-700 leading-relaxed mt-4">
                                            {!! nl2br(e($experience->description)) !!}
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 font-extrabold uppercase tracking-wide pl-6">// Belum ada data pengalaman kerja.</p>
                    @endforelse
                </div>
            </div>

            <!-- 2. Education Column -->
            <div>
                <div class="flex items-center gap-3 mb-12">
                    <div class="p-3 bg-black text-[#ff5722] border-2 border-black shadow-[3px_3px_0px_#ff5722]">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.62 48.62 0 0112 20.904a48.62 48.62 0 017.231-4.41 60.354 60.354 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75" />
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black uppercase tracking-tighter">Edukasi Akademik</h3>
                </div>

                <!-- Brutalist Timeline Path -->
                <div class="relative border-l-4 border-black ml-4 space-y-10">
                    @forelse ($user->educations as $education)
                        <div class="relative pl-8">
                            <!-- Bullet Dot Block -->
                            <div class="absolute -left-[14px] top-6 w-5 h-5 bg-black border-3 border-[#ff5722] shadow-[2px_2px_0px_#ff5722]"></div>
                            
                            <!-- Card Content inside Brutalist Box -->
                            <div class="bg-white border-3 border-black p-6 shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 transition duration-150">
                                <!-- Period Badge -->
                                <span class="inline-flex items-center px-3 py-1 bg-black text-[#ff5722] border-2 border-black font-extrabold text-xs uppercase shadow-[2px_2px_0px_#ff5722] mb-4">
                                    {{ $education->start_year }} - {{ $education->end_year ?? 'Sekarang' }}
                                </span>
                                
                                <!-- Degree & Institution -->
                                <h4 class="text-xl font-black uppercase tracking-tight text-black">{{ $education->degree }}</h4>
                                <span class="text-sm font-extrabold uppercase text-[#ff5722] tracking-wider">{{ $education->institution_name }}</span>
                                
                                <!-- Description -->
                                @if ($education->description)
                                    @php
                                        $eduPoints = json_decode($education->description, true);
                                    @endphp
                                    @if (is_array($eduPoints))
                                        <ul class="list-disc pl-5 mt-4 space-y-1.5 text-sm font-bold text-slate-700 leading-relaxed">
                                            @foreach ($eduPoints as $point)
                                                @if (trim($point) !== '')
                                                    <li>{{ $point }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-sm font-bold text-slate-700 leading-relaxed mt-4">
                                            {!! nl2br(e($education->description)) !!}
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @empty
                        <p class="text-slate-500 font-extrabold uppercase tracking-wide pl-6">// Belum ada data riwayat akademik.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
