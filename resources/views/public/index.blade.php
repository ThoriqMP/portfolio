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
                    <a href="#contact" class="inline-flex items-center justify-center px-8 py-4 text-base font-extrabold uppercase tracking-wider text-black bg-white hover:bg-black hover:text-white border-3 border-black shadow-[4px_4px_0px_#000000] hover:shadow-[6px_6px_0px_#000000] active:translate-x-1 active:translate-y-1 active:shadow-none transition-all duration-100">
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
                        <p class="text-sm font-bold text-slate-700 leading-relaxed mb-4 flex-grow">
                            {{ $project->description }}
                        </p>

                        <!-- Project Badges -->
                        @if($project->badges && $project->badges->count() > 0)
                            <div class="flex flex-wrap gap-1.5 mb-6">
                                @foreach($project->badges as $badge)
                                    <span class="px-2 py-0.5 border border-black shadow-[1px_1px_0px_#000000] font-sans font-bold text-xxs uppercase tracking-wider inline-block"
                                          style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }};">
                                        {{ $badge->name }}
                                    </span>
                                @endforeach
                            </div>
                        @endif

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

<!-- Contact Section (High-Contrast Brutalist Box) -->
<section id="contact" class="py-24 bg-white border-b-8 border-black">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Title (Brutalist Panel) -->
        <div class="border-4 border-black p-8 bg-black text-white shadow-[6px_6px_0px_#ff5722] max-w-3xl mx-auto mb-16 text-center">
            <h2 class="text-4xl sm:text-5xl font-black uppercase tracking-tighter">
                Hubungi Saya
            </h2>
            <p class="text-slate-350 text-sm uppercase tracking-widest mt-3 font-semibold">
                // Mari terhubung melalui kontak atau sosial media di bawah ini
            </p>
        </div>

        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Left: Direct Contacts -->
                <div class="bg-[#f5f5f5] border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#000000] flex flex-col justify-between">
                    <div>
                        <span class="inline-block px-3 py-1 bg-black text-[#ff5722] border-2 border-black font-extrabold text-xs uppercase shadow-[2px_2px_0px_#ff5722] mb-6">
                            // DIRECT CHAT & EMAIL
                        </span>
                        <h3 class="text-2xl font-black uppercase tracking-tight text-black mb-4">Kontak Langsung</h3>
                        <p class="text-sm font-bold text-slate-700 leading-relaxed mb-8">
                            Silakan hubungi saya kapan saja untuk mendiskusikan peluang kerja sama proyek baru atau sekadar menyapa.
                        </p>
                    </div>

                    <div class="space-y-4">
                        @if ($user->socialLinks->count() > 0)
                            @forelse ($user->socialLinks->whereIn('icon', ['email', 'whatsapp']) as $social)
                                @php
                                    $href = $social->link;
                                    $target = 'target="_blank"';
                                    if ($social->icon === 'email') {
                                        $href = str_starts_with($social->link, 'mailto:') ? $social->link : 'mailto:' . $social->link;
                                        $target = '';
                                    } elseif ($social->icon === 'whatsapp') {
                                        if (!str_starts_with($social->link, 'http://') && !str_starts_with($social->link, 'https://')) {
                                            $cleanNumber = preg_replace('/[^0-9]/', '', $social->link);
                                            $href = 'https://wa.me/' . $cleanNumber;
                                        }
                                    }
                                @endphp
                                <a href="{{ $href }}" {!! $target !!} rel="noopener noreferrer" class="flex items-center gap-3 p-4 border-3 border-black shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all"
                                   style="background-color: {{ $social->bg_color }}; color: {{ $social->text_color }};">
                                    <div class="flex-shrink-0 flex items-center justify-center">
                                        @if($social->icon === 'email')
                                            <svg class="w-6 h-6 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                                            </svg>
                                        @elseif($social->icon === 'whatsapp')
                                            <svg class="w-6 h-6 fill-currentColor" viewBox="0 0 24 24">
                                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.458L0 24zm6.26-4.526c1.661.987 3.291 1.488 4.966 1.489 5.517 0 10.005-4.48 10.008-9.998.001-2.673-1.037-5.185-2.923-7.072C16.483 2.006 13.977.969 11.3.969 5.787.969 1.3 5.449 1.297 10.969c-.001 1.761.464 3.424 1.348 4.96L1.67 21.5l5.59-1.463c-.347-.206-.693-.412-1.04-.619-.103-.062-.206-.124-.309-.187-.001-.001-.001-.001-.001-.001v.001zm11.517-7.834c-.27-.135-1.597-.788-1.846-.878-.248-.09-.429-.135-.61.135-.181.271-.7 1.035-.858 1.216-.158.18-.316.203-.586.068-.27-.136-1.14-.42-2.171-1.339-.802-.716-1.343-1.6-1.501-1.871-.158-.271-.017-.417.118-.552.122-.122.27-.316.406-.474.135-.158.18-.271.27-.451.09-.18.045-.339-.022-.475-.068-.135-.61-1.467-.836-2.009-.22-.53-.442-.458-.61-.466-.158-.008-.339-.008-.52-.008-.18 0-.474.068-.722.339-.248.271-.948.927-.948 2.26 0 1.332.97 2.617 1.106 2.798.135.18 1.907 2.911 4.62 4.082.645.278 1.149.444 1.542.569.648.206 1.237.177 1.703.107.519-.078 1.597-.653 1.822-1.284.226-.632.226-1.173.158-1.285-.068-.113-.248-.18-.519-.315z" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block text-xxs font-black opacity-70 uppercase tracking-widest">{{ $social->icon === 'email' ? 'KIRIM EMAIL' : 'WHATSAPP CHAT' }}</span>
                                        <span class="block text-sm font-black truncate">{{ $social->name }}</span>
                                    </div>
                                </a>
                            @empty
                                <div class="text-xs font-bold text-slate-400 uppercase italic p-4 border-2 border-dashed border-slate-350">// Kontak belum diatur</div>
                            @endforelse
                        @else
                            {{-- Fallback to legacy contact fields --}}
                            @if ($user->email_contact)
                                <a href="mailto:{{ $user->email_contact }}" class="flex items-center gap-3 p-4 bg-white border-3 border-black shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                                    <div class="p-2 bg-black text-white border-2 border-black flex items-center justify-center">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block text-xxs font-black text-slate-500 uppercase tracking-widest">KIRIM EMAIL</span>
                                        <span class="block text-sm font-black text-black truncate">{{ $user->email_contact }}</span>
                                    </div>
                                </a>
                            @endif

                            @if ($user->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" rel="noopener noreferrer" class="flex items-center gap-3 p-4 bg-white border-3 border-black shadow-[3px_3px_0px_#000000] hover:shadow-[5px_5px_0px_#000000] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                                    <div class="p-2 bg-emerald-500 text-black border-2 border-black flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.458L0 24zm6.26-4.526c1.661.987 3.291 1.488 4.966 1.489 5.517 0 10.005-4.48 10.008-9.998.001-2.673-1.037-5.185-2.923-7.072C16.483 2.006 13.977.969 11.3.969 5.787.969 1.3 5.449 1.297 10.969c-.001 1.761.464 3.424 1.348 4.96L1.67 21.5l5.59-1.463c-.347-.206-.693-.412-1.04-.619-.103-.062-.206-.124-.309-.187-.001-.001-.001-.001-.001-.001v.001zm11.517-7.834c-.27-.135-1.597-.788-1.846-.878-.248-.09-.429-.135-.61.135-.181.271-.7 1.035-.858 1.216-.158.18-.316.203-.586.068-.27-.136-1.14-.42-2.171-1.339-.802-.716-1.343-1.6-1.501-1.871-.158-.271-.017-.417.118-.552.122-.122.27-.316.406-.474.135-.158.18-.271.27-.451.09-.18.045-.339-.022-.475-.068-.135-.61-1.467-.836-2.009-.22-.53-.442-.458-.61-.466-.158-.008-.339-.008-.52-.008-.18 0-.474.068-.722.339-.248.271-.948.927-.948 2.26 0 1.332.97 2.617 1.106 2.798.135.18 1.907 2.911 4.62 4.082.645.278 1.149.444 1.542.569.648.206 1.237.177 1.703.107.519-.078 1.597-.653 1.822-1.284.226-.632.226-1.173.158-1.285-.068-.113-.248-.18-.519-.315z" />
                                        </svg>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <span class="block text-xxs font-black text-slate-500 uppercase tracking-widest">WHATSAPP CHAT</span>
                                        <span class="block text-sm font-black text-black truncate">+{{ $user->phone }}</span>
                                    </div>
                                </a>
                            @endif

                            @if (!$user->email_contact && !$user->phone)
                                <div class="text-xs font-bold text-slate-400 uppercase italic p-4 border-2 border-dashed border-slate-350">// Kontak belum diatur</div>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Right: Social Media Buttons -->
                <div class="bg-black border-4 border-black p-6 sm:p-8 shadow-[6px_6px_0px_#ff5722] flex flex-col justify-between text-white">
                    <div>
                        <span class="inline-block px-3 py-1 bg-[#ff5722] text-black border-2 border-black font-extrabold text-xs uppercase shadow-[2px_2px_0px_#ffffff] mb-6">
                            // SOCIAL PROFILES
                        </span>
                        <h3 class="text-2xl font-black uppercase tracking-tight text-white mb-4">Media Sosial</h3>
                        <p class="text-sm font-bold text-slate-300 leading-relaxed mb-8">
                            Ikuti atau hubungi saya melalui media sosial saya untuk melihat proyek lain atau koneksi profesional.
                        </p>
                    </div>

                    <div class="space-y-4">
                        @if ($user->socialLinks->count() > 0)
                            @forelse ($user->socialLinks->whereNotIn('icon', ['email', 'whatsapp']) as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" 
                                   class="flex items-center justify-between p-4 border-3 border-black shadow-[3px_3px_0px_#ff5722] hover:shadow-[5px_5px_0px_#ffffff] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all"
                                   style="background-color: {{ $social->bg_color }}; color: {{ $social->text_color }}; border-color: #000000;">
                                    <span class="text-sm font-black uppercase tracking-wider">{{ $social->name }}</span>
                                    @switch($social->icon)
                                        @case('github')
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                                            @break
                                        @case('linkedin')
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                                            @break
                                        @case('instagram')
                                            <svg class="w-5 h-5 fill-currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                                            @break
                                        @case('facebook')
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            @break
                                        @case('youtube')
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M23.498 6.163a3.003 3.003 0 0 0-2.11-2.108C19.525 3.5 12 3.5 12 3.5s-7.525 0-9.388.555A3.002 3.002 0 0 0 .502 6.163C0 8.07 0 12 0 12s0 3.93.502 5.837a3.003 3.003 0 0 0 2.11 2.108C4.475 20.5 12 20.5 12 20.5s7.525 0 9.388-.555a3.002 3.002 0 0 0 2.11-2.108C24 15.93 24 12 24 12s0-3.93-.502-5.837zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                                            @break
                                        @case('twitter')
                                            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                                            @break
                                        @default
                                            <svg class="w-5 h-5 fill-none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 011.242 7.244l-4.5 4.5a4.5 4.5 0 01-6.364-6.364l1.757-1.757m13.35-.622l1.757-1.757a4.5 4.5 0 00-6.364-6.364l-4.5 4.5a4.5 4.5 0 001.242 7.244" /></svg>
                                    @endswitch
                                </a>
                            @empty
                                <div class="text-xs font-bold text-slate-400 uppercase italic p-4 border-2 border-dashed border-slate-700">// Sosial media belum diatur</div>
                            @endforelse
                        @else
                            {{-- Fallback to legacy social link fields --}}
                            @if ($user->github_link)
                                <a href="{{ $user->github_link }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-white border-3 border-black text-black shadow-[3px_3px_0px_#ff5722] hover:shadow-[5px_5px_0px_#ffffff] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                                    <span class="text-sm font-black uppercase tracking-wider">GitHub Profil</span>
                                    <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" />
                                    </svg>
                                </a>
                            @endif

                            @if ($user->linkedin_link)
                                <a href="{{ $user->linkedin_link }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-[#0077b5] border-3 border-black text-white shadow-[3px_3px_0px_#ff5722] hover:shadow-[5px_5px_0px_#ffffff] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                                    <span class="text-sm font-black uppercase tracking-wider text-white">LinkedIn Profil</span>
                                    <svg class="w-5 h-5 fill-current text-white" viewBox="0 0 24 24">
                                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" />
                                    </svg>
                                </a>
                            @endif

                            @if ($user->instagram_link)
                                <a href="{{ $user->instagram_link }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between p-4 bg-[#e1306c] border-3 border-black text-white shadow-[3px_3px_0px_#ff5722] hover:shadow-[5px_5px_0px_#ffffff] hover:-translate-x-0.5 hover:-translate-y-0.5 active:translate-x-0 active:translate-y-0 active:shadow-none transition-all">
                                    <span class="text-sm font-black uppercase tracking-wider text-white">Instagram</span>
                                    <svg class="w-5 h-5 fill-currentColor text-white" viewBox="0 0 24 24">
                                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                    </svg>
                                </a>
                            @endif

                            @if (!$user->github_link && !$user->linkedin_link && !$user->instagram_link)
                                <div class="text-xs font-bold text-slate-400 uppercase italic p-4 border-2 border-dashed border-slate-700">// Sosial media belum diatur</div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
