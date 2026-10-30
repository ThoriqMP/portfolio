@extends('layouts.public')

@section('content')
<!-- Hero Section (Subtle Warm Mesh, Coordinate Grid & Cutout Portrait) -->
<section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden bg-gradient-to-b from-accent-50/60 via-white to-white">
    <!-- Subtle Background Coordinate Grid -->
    <div class="absolute inset-0 bg-hero-grid pointer-events-none opacity-70"></div>
    
    <!-- Soft Reddish-Orange Ambient Glow -->
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-accent-400/15 blur-[120px] rounded-full pointer-events-none -z-0"></div>

    <!-- Giant Faint Background Watermark -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 select-none text-[6rem] sm:text-[9rem] md:text-[13rem] lg:text-[16rem] font-black text-slate-900/[0.03] uppercase tracking-tighter pointer-events-none z-0 whitespace-nowrap">
        {{ strtoupper($user->title ?? 'FULLSTACK DEVELOPER') }}
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center">
            
            <!-- Left Column: Typographic Hero & Intro -->
            <div class="lg:col-span-4 space-y-5 text-center lg:text-left">
                <div class="space-y-1">
                    <span class="block text-2xl sm:text-3xl font-extrabold uppercase tracking-tight text-slate-800">
                        I'M
                    </span>
                    <h1 class="text-6xl sm:text-7xl md:text-8xl font-black italic tracking-tighter text-slate-950 leading-none">
                        {{ explode(' ', $user->name ?? 'Thoriq')[0] }}
                    </h1>
                </div>

                <!-- Stylized Title Pill -->
                <div>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] sm:text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-sm shadow-accent-500/30">
                        {{ $user->title ?? 'FULLSTACK WEB DEVELOPER' }}
                    </span>
                </div>

                <!-- Bio / Intro Copy from Database -->
                <p class="text-sm sm:text-base font-normal text-slate-600 leading-relaxed max-w-md mx-auto lg:mx-0">
                    {{ $user->bio ?? 'Membangun pengalaman web modern, responsif, berkinerja tinggi, dan berestetika premium.' }}
                </p>

                <!-- Quick Action Buttons -->
                <div class="pt-2 flex items-center justify-center lg:justify-start gap-3">
                    <a href="#projects" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-slate-900 hover:bg-accent-500 text-white text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm">
                        Explore Work
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <a href="#about" class="inline-flex items-center px-5 py-2.5 rounded-full border border-slate-300 hover:border-slate-800 text-xs sm:text-sm font-semibold text-slate-700 hover:text-slate-950 transition-colors">
                        About Me
                    </a>
                </div>
            </div>

            <!-- Middle Column: Portrait Cutout Photo -->
            <div class="lg:col-span-4 flex justify-center order-first lg:order-none">
                <div class="relative w-64 h-80 sm:w-80 sm:h-96 md:w-96 md:h-[430px] flex items-end justify-center">
                    <!-- Subtle glow behind portrait -->
                    <div class="absolute inset-0 bg-gradient-to-t from-accent-500/20 to-transparent rounded-full blur-2xl -z-10"></div>

                    @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                        <div class="relative w-full h-full flex items-end justify-center">
                            <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                                 alt="{{ $user->name }}" 
                                 class="max-h-full max-w-full object-contain drop-shadow-2xl transition-transform duration-300">
                        </div>
                    @else
                        <!-- Fallback Designer Portrait -->
                        <div class="relative w-full h-full overflow-hidden rounded-3xl group">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=900&q=80" 
                                 alt="{{ $user->name ?? 'Thoriq' }}" 
                                 class="w-full h-full object-cover object-top drop-shadow-2xl">
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Follow Me Socials & Big Display Label -->
            <div class="lg:col-span-4 flex flex-col justify-between h-full space-y-12 lg:space-y-24 text-center lg:text-left">
                <!-- Top: Follow Me Socials -->
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">
                        Follow me
                    </span>
                    <div class="flex items-center justify-center lg:justify-start gap-2.5">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks->take(4) as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 shadow-sm text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="{{ $social->name }}">
                                    <span class="text-xs font-bold uppercase">{{ substr($social->name, 0, 2) }}</span>
                                </a>
                            @endforeach
                        @else
                            @if ($user->linkedin_link ?? true)
                                <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 shadow-sm text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="LinkedIn">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                                </a>
                            @endif
                            @if ($user->github_link ?? true)
                                <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 shadow-sm text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="GitHub">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                                </a>
                            @endif
                            <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-slate-200/80 shadow-sm text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="Instagram">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                            </a>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto lg:mx-0 leading-relaxed">
                        Membangun solusi digital intuitif, fungsional, dan memberikan nilai nyata bagi bisnis.
                    </p>
                </div>

                <!-- Bottom: Big Display Label -->
                <div class="pt-4 lg:pt-0">
                    <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold uppercase tracking-tight text-slate-900 leading-tight">
                        {{ strtoupper($user->title ?? 'FULLSTACK WEB DEVELOPER') }}
                    </h2>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Section ("Designing with Purpose, Building with Passion") -->
<section id="about" class="py-20 md:py-28 bg-white border-y border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left: Customizable About Photo Card -->
            <div class="lg:col-span-6">
                @php
                    $aboutImg = ($user->about_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->about_image_path)) 
                        ? asset('storage/' . $user->about_image_path) 
                        : 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=1200&q=80';
                @endphp
                <div class="relative overflow-hidden rounded-3xl shadow-[0_15px_35px_rgba(0,0,0,0.06)] border border-slate-200/60 aspect-[4/3] group">
                    <img src="{{ $aboutImg }}" 
                         alt="{{ $user->about_title ?? 'About Me' }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                </div>
            </div>

            <!-- Right: About Editorial & CTA -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-accent-500 mb-2 inline-block">
                        ABOUT ME
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        {{ $user->about_title ?? 'Designing with Purpose, Building with Passion' }}
                    </h2>
                </div>

                <div class="text-sm sm:text-base text-slate-600 leading-relaxed space-y-4">
                    @if ($user->about_description)
                        <p class="whitespace-pre-line">{{ $user->about_description }}</p>
                    @else
                        <p>
                            {{ $user->bio ?? 'Saya adalah seorang Fullstack Web Developer yang bersemangat dalam merancang dan mengembangkan aplikasi web modern.' }}
                        </p>
                        <p>
                            Fokus saya adalah menciptakan pengalaman digital yang seimbang antara kemudahan navigasi pengguna (UX), estetika visual yang bersih, serta arsitektur backend yang aman dan berkinerja tinggi.
                        </p>
                    @endif
                </div>

                <!-- Badges Highlights from Database -->
                @if ($user->badges && $user->badges->count() > 0)
                    <div class="pt-2">
                        <span class="block text-xxs font-bold uppercase tracking-wider text-slate-400 mb-2">Core Tech Stack:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($user->badges as $badge)
                                <span class="px-3 py-1 rounded-full text-xs font-bold tracking-wider uppercase border"
                                      style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.08);">
                                    {{ $badge->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="pt-2">
                    <a href="#services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-sm font-semibold shadow-md shadow-accent-500/25 hover:shadow-lg hover:shadow-accent-500/35 transition-all">
                        Lihat Keahlian & Layanan
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats / Metrics Strip (Connected to Database & Section Settings) -->
<section class="py-12 md:py-16 bg-white border-b border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-slate-100">
            <!-- Stat 1: Years Experience -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->years_experience ?? '3+' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Years Experience
                </span>
            </div>

            <!-- Stat 2: Projects Completed -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->projects_completed ?? ($user->projects->count() > 0 ? $user->projects->count() . '+' : '10+') }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Project Completed
                </span>
            </div>

            <!-- Stat 3: Support Available -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->support_available ?? '24/7' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Support Available
                </span>
            </div>

            <!-- Stat 4: Client Satisfaction -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->client_satisfaction ?? '98%' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Client Satisfaction
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Services / Specialties Bento Grid Section -->
<section id="services" class="py-24 md:py-32 bg-[#FAFAFC]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    SERVICES & SKILLS
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Designing digital solutions that empower your visions
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                Menyediakan solusi rekayasa web end-to-end, mulai dari antarmuka modern yang responsif hingga struktur basis data yang andal dan aman.
            </p>
        </div>

        @php
            $bento1 = ($user->bento_image_1 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_1))
                ? asset('storage/' . $user->bento_image_1)
                : 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80';
            $bento2 = ($user->bento_image_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_2))
                ? asset('storage/' . $user->bento_image_2)
                : 'https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=800&q=80';
        @endphp

        <!-- 6-Item Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Card 01: UI/UX & Frontend -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        01
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Frontend & UI Design
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Membangun antarmuka pengguna responsif, interaktif, dan modern menggunakan Tailwind CSS, Blade, dan JavaScript dengan aksesibilitas tinggi.
                    </p>
                </div>
            </div>

            <!-- Card 02: Fullstack Web Development -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        02
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Backend & API Architecture
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Mengembangkan logika server berkinerja tinggi, RESTful API, autentikasi aman, serta integrasi layanan pihak ketiga menggunakan Laravel dan MySQL.
                    </p>
                </div>
            </div>

            <!-- Bento Visual Showcase 1 (Customizable Bento Image 1) -->
            <div class="overflow-hidden rounded-3xl border border-slate-200/60 shadow-sm aspect-[4/3] md:aspect-auto group">
                <img src="{{ $bento1 }}" 
                     alt="Mobile App Showcase" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Bento Visual Showcase 2 (Customizable Bento Image 2) -->
            <div class="overflow-hidden rounded-3xl border border-slate-200/60 shadow-sm aspect-[4/3] md:aspect-auto group">
                <img src="{{ $bento2 }}" 
                     alt="Brand Graphic Showcase" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
            </div>

            <!-- Card 03: Database & Performance Optimization -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        03
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Database & Query Optimization
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Desain skema relasional, optimasi kueri SQL, indexing, serta manajemen migrasi database terstruktur untuk efisiensi data berskala besar.
                    </p>
                </div>
            </div>

            <!-- Card 04: Maintenance & Scalability -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        04
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        System Security & Deployment
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Penerapan perlindungan keamanan standar (CSRF, XSS, sanitasi input), konfigurasi server, serta pemeliharaan berkala sistem produksi.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Experience & Education Section ("Exploring My Professional Journey" with Warm Tinted Grid) -->
<section id="experience" class="py-24 md:py-32 bg-warm-grid border-y border-accent-200/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header with Tab Toggles for Experiences & Educations -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-600 block">
                    CAREER & ACADEMIC
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Exploring My Growth<br>as {{ $user->title ? (str_contains(strtolower($user->title), 'developer') ? 'a Developer' : 'a Professional') : 'a Professional' }}
                </h2>
            </div>

            <!-- Tab Buttons -->
            <div class="flex items-center gap-2 p-1.5 bg-white/80 backdrop-blur-md rounded-full border border-accent-200 shadow-sm">
                <button type="button" id="tab-btn-exp" class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white transition-all shadow-sm">
                    Work Experience ({{ $user->experiences->count() }})
                </button>
                <button type="button" id="tab-btn-edu" class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all">
                    Education ({{ $user->educations->count() }})
                </button>
            </div>
        </div>

        <!-- 1. Experience List Container -->
        <div id="tab-content-exp" class="transition-opacity duration-300">
            <div class="divide-y divide-accent-300/40 border-y border-accent-300/40">
                @forelse ($user->experiences as $exp)
                    <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                            <!-- Period / Year -->
                            <div class="w-full sm:w-48 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                                    {{ $exp->start_date ? $exp->start_date->format('Y') : '2023' }} &mdash; 
                                    {{ $exp->end_date ? $exp->end_date->format('Y') : 'Sekarang' }}
                                </span>
                            </div>

                            <!-- Role / Title -->
                            <div class="flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $exp->position }}
                                </h3>
                                @if ($exp->description)
                                    @php
                                        $expDesc = json_decode($exp->description, true);
                                    @endphp
                                    @if (is_array($expDesc))
                                        <ul class="list-disc pl-5 mt-2 space-y-1 text-xs sm:text-sm text-slate-600">
                                            @foreach ($expDesc as $bullet)
                                                @if (trim($bullet) !== '')
                                                    <li>{{ $bullet }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl whitespace-pre-line">
                                            {{ $exp->description }}
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <!-- Company / Studio -->
                            <div class="sm:text-right shrink-0">
                                <span class="text-sm sm:text-base font-bold text-slate-800">
                                    {{ $exp->company_name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-500 text-sm font-bold uppercase">
                        Belum ada riwayat pengalaman kerja yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 2. Education List Container (Hidden by default) -->
        <div id="tab-content-edu" class="hidden opacity-0 transition-opacity duration-300">
            <div class="divide-y divide-accent-300/40 border-y border-accent-300/40">
                @forelse ($user->educations as $edu)
                    <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                            <div class="w-full sm:w-48 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                                    {{ $edu->start_year }} &mdash; {{ $edu->end_year ?? 'Sekarang' }}
                                </span>
                            </div>

                            <div class="flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $edu->degree }}
                                </h3>
                                @if ($edu->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl whitespace-pre-line">
                                        {{ $edu->description }}
                                    </p>
                                @endif
                            </div>

                            <div class="sm:text-right shrink-0">
                                <span class="text-sm sm:text-base font-bold text-slate-800">
                                    {{ $edu->institution_name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-500 text-sm font-bold uppercase">
                        Belum ada data riwayat pendidikan akademik.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- Portfolio / Projects Section ("Bringing Ideas to Life through Design") -->
<section id="projects" class="py-24 md:py-32 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    PORTFOLIO
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Bringing Ideas to Life<br>through Code & Design
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                Koleksi proyek pilihan yang mencakup aplikasi web berskala penuh, dashboard analitik, dan sistem informasi interaktif.
            </p>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
            @forelse ($user->projects as $index => $project)
                @php
                    $presetImages = [
                        'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1000&q=80',
                        'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=1000&q=80',
                    ];
                    $imgSrc = ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path)) 
                        ? asset('storage/' . $project->image_path) 
                        : ($presetImages[$index % count($presetImages)]);
                @endphp

                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-slate-200/80 shadow-md hover:shadow-2xl transition-all duration-300">
                    <!-- Project Image with Zoom on Hover -->
                    <img src="{{ $imgSrc }}" 
                         alt="{{ $project->title }}" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                    <!-- Dark Bottom Vignette Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>

                    <!-- Card Content Overlay -->
                    <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                        <!-- Top Link Arrow & Badges -->
                        <div class="flex items-start justify-between gap-3">
                            <div class="flex flex-wrap gap-1.5">
                                @if($project->badges && $project->badges->count() > 0)
                                    @foreach($project->badges->take(3) as $badge)
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border shadow-sm backdrop-blur-sm"
                                              style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(255,255,255,0.15);">
                                            {{ $badge->name }}
                                        </span>
                                    @endforeach
                                @endif
                            </div>

                            <a href="{{ route('projects.show', $project->id) }}" class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white hover:bg-accent-500 hover:scale-110 flex items-center justify-center transition-all duration-200 shrink-0" title="Detail Proyek">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>

                        <!-- Bottom Info -->
                        <div class="flex items-end justify-between gap-4">
                            <div class="space-y-1">
                                <a href="{{ route('projects.show', $project->id) }}" class="text-xl sm:text-2xl font-bold text-white hover:text-accent-400 transition-colors block">
                                    {{ $project->title }}
                                </a>
                                <span class="text-xs sm:text-sm text-slate-300 block line-clamp-1">
                                    {{ $project->description }}
                                </span>
                            </div>
                            <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full shrink-0">
                                {{ $project->created_at ? $project->created_at->format('Y') : date('Y') }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-500 font-bold uppercase">
                    Belum ada portofolio proyek yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonials Section (Interactive Visitor Input Form + Device Restriction) -->
<section id="testimonials" class="py-24 md:py-32 bg-[#FAFAFC] border-t border-slate-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    TESTIMONIALS & FEEDBACK
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Testimonials that<br>highlight my work
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                Ulasan langsung dari rekan kerja, klien, atau pengunjung. Anda dapat memberikan feedback melalui form di bawah (dibatasi 1 ulasan per perangkat).
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-start">
            
            <!-- Left Column: Testimonials Display Carousel / List (7 cols) -->
            <div class="lg:col-span-7 bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-[0_10px_30px_rgba(0,0,0,0.04)] relative">
                <!-- Accent Quote Mark Icon -->
                <div class="text-accent-500 text-6xl font-serif font-black leading-none mb-6 select-none">
                    &ldquo;
                </div>

                <!-- Testimonials Dynamic List -->
                <div id="testimonial-list-container">
                    @if ($testimonials && $testimonials->count() > 0)
                        @foreach ($testimonials as $idx => $t)
                            <div class="testimonial-slide {{ $idx === 0 ? 'active' : 'hidden opacity-0' }} transition-opacity duration-300">
                                <div class="space-y-4">
                                    <!-- Stars Rating -->
                                    <div class="flex items-center gap-1 text-accent-500 text-sm">
                                        @for ($s = 1; $s <= 5; $s++)
                                            <span>{{ $s <= $t->rating ? '★' : '☆' }}</span>
                                        @endfor
                                    </div>

                                    <!-- Quote -->
                                    <p class="text-lg sm:text-xl font-bold text-slate-900 leading-relaxed">
                                        &ldquo;{{ $t->content }}&rdquo;
                                    </p>

                                    <!-- Author Info -->
                                    <div class="pt-2 flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-accent-500 text-white font-extrabold flex items-center justify-center text-sm shadow-sm">
                                            {{ substr($t->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="block text-base font-extrabold text-slate-950">{{ $t->name }}</span>
                                            <span class="block text-xs font-medium text-slate-500">
                                                {{ $t->role }}{{ $t->company ? ' &bull; ' . $t->company : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Welcoming placeholder -->
                        <div class="py-6 text-center space-y-3">
                            <p class="text-base sm:text-lg font-bold text-slate-800 leading-relaxed">
                                &ldquo;Belum ada testimoni yang masuk. Jadilah orang pertama yang meninggalkan pesan atau feedback untuk portofolio ini!&rdquo;
                            </p>
                            <span class="block text-xs text-slate-400 font-bold uppercase tracking-wider">// Silakan isi formulir di samping</span>
                        </div>
                    @endif
                </div>

                <!-- Slider Controls if multiple testimonials -->
                @if ($testimonials && $testimonials->count() > 1)
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100 mt-8">
                        <button id="prev-testimonial" type="button" class="w-9 h-9 rounded-full border border-slate-200 hover:border-slate-800 text-slate-600 hover:text-slate-950 flex items-center justify-center transition-all" aria-label="Previous">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                        </button>
                        <button id="next-testimonial" type="button" class="w-9 h-9 rounded-full bg-accent-500 hover:bg-accent-600 text-white flex items-center justify-center shadow-md shadow-accent-500/20 transition-all" aria-label="Next">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Right Column: Interactive Testimonial Input Form with Device Restriction (5 cols) -->
            <div class="lg:col-span-5 bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-8 shadow-sm">
                
                <!-- Already Submitted State Card -->
                <div id="testimonial-already-submitted" class="hidden p-6 bg-accent-50 border border-accent-200 rounded-2xl space-y-3 text-center">
                    <div class="w-12 h-12 rounded-full bg-accent-500 text-white flex items-center justify-center mx-auto shadow-md shadow-accent-500/20">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="text-base font-extrabold text-slate-900">Testimoni Anda Telah Diterima!</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Perangkat Anda telah mengirimkan ulasan untuk portofolio ini. Terima kasih banyak atas apresiasi dan dukungan Anda!
                    </p>
                </div>

                <!-- Input Form -->
                <form id="testimonial-form" class="space-y-4">
                    @csrf
                    <input type="hidden" name="device_fingerprint" id="device_fingerprint">

                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block mb-1">
                            Tinggalkan Ulasan
                        </span>
                        <h3 class="text-xl font-extrabold text-slate-950 tracking-tight">
                            Beri Testimoni Anda
                        </h3>
                        <p class="text-xs text-slate-500 mt-1">Dibatasi 1 testimoni per perangkat.</p>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="t-name" class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" id="t-name" required placeholder="Contoh: Budi Santoso"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-accent-500 focus:bg-white transition-all">
                    </div>

                    <!-- Role & Company Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div>
                            <label for="t-role" class="block text-xs font-bold text-slate-700 mb-1">Peran / Profesi *</label>
                            <input type="text" name="role" id="t-role" required placeholder="Klien / Rekan Kerja"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-accent-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label for="t-company" class="block text-xs font-bold text-slate-700 mb-1">Instansi / Perusahaan</label>
                            <input type="text" name="company" id="t-company" placeholder="Opsional"
                                class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-accent-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <!-- Star Rating Selector -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 mb-1">Rating Kepuasan</label>
                        <div class="flex items-center gap-1.5" id="star-selector">
                            <input type="hidden" name="rating" id="t-rating" value="5">
                            <button type="button" data-star="1" class="star-btn text-xl text-accent-500 hover:scale-110 transition-transform">★</button>
                            <button type="button" data-star="2" class="star-btn text-xl text-accent-500 hover:scale-110 transition-transform">★</button>
                            <button type="button" data-star="3" class="star-btn text-xl text-accent-500 hover:scale-110 transition-transform">★</button>
                            <button type="button" data-star="4" class="star-btn text-xl text-accent-500 hover:scale-110 transition-transform">★</button>
                            <button type="button" data-star="5" class="star-btn text-xl text-accent-500 hover:scale-110 transition-transform">★</button>
                            <span id="rating-text" class="text-xs font-bold text-slate-500 ml-2">5 dari 5 Bintang</span>
                        </div>
                    </div>

                    <!-- Testimonial Content -->
                    <div>
                        <label for="t-content" class="block text-xs font-bold text-slate-700 mb-1">Pesan Testimoni *</label>
                        <textarea name="content" id="t-content" rows="3" required placeholder="Tuliskan pengalaman atau kesan bekerja sama..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 text-xs sm:text-sm font-medium focus:outline-none focus:border-accent-500 focus:bg-white transition-all"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="t-submit-btn" class="w-full py-3 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-xs sm:text-sm shadow-md shadow-accent-500/25 transition-all">
                            Kirim Testimoni
                        </button>
                    </div>

                    <div id="t-message" class="hidden text-xs font-bold p-2.5 rounded-xl text-center"></div>
                </form>

            </div>

        </div>
    </div>
</section>

<!-- Call to Action Banner ("Let's Build Something Truly Meaningful Together") -->
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $ctaImg = ($user->cta_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->cta_image_path))
                ? asset('storage/' . $user->cta_image_path)
                : 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=80';
        @endphp

        <div class="relative bg-warm-grid rounded-3xl border border-accent-200/80 shadow-[0_15px_40px_rgba(255,77,45,0.08)] overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 sm:p-12 md:p-16">
                
                <!-- Left Banner Copy -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left z-10">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        Let's Build Something Truly<br>
                        <span class="italic font-bold text-accent-500">Meaningful Together</span>
                    </h2>
                    
                    <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                        Terbuka untuk peluang kerja sama pembuatan aplikasi web, integrasi sistem, konsultasi teknologi, maupun proyek freelance baru.
                    </p>

                    <div class="pt-2">
                        <a href="mailto:{{ $user->email_contact ?? 'hi@getincontact.com' }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-sm sm:text-base shadow-lg shadow-accent-500/30 hover:shadow-xl hover:shadow-accent-500/40 hover:-translate-y-0.5 transition-all">
                            Start a Project
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Banner Cutout Image -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end z-10">
                    <div class="relative w-64 h-72 sm:w-72 sm:h-80 md:w-80 md:h-96 overflow-hidden rounded-2xl">
                        <img src="{{ $ctaImg }}" 
                             alt="Let's build together" 
                             class="w-full h-full object-cover object-top drop-shadow-xl">
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Vanilla JS for Experience/Education Tabs, Device-Restricted Testimonials & Slider -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. TABS: Work Experience vs Education
    const tabBtnExp = document.getElementById('tab-btn-exp');
    const tabBtnEdu = document.getElementById('tab-btn-edu');
    const tabContentExp = document.getElementById('tab-content-exp');
    const tabContentEdu = document.getElementById('tab-content-edu');

    if (tabBtnExp && tabBtnEdu) {
        tabBtnExp.addEventListener('click', () => {
            tabBtnExp.className = 'px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white transition-all shadow-sm';
            tabBtnEdu.className = 'px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all';
            tabContentEdu.classList.add('hidden', 'opacity-0');
            tabContentExp.classList.remove('hidden');
            setTimeout(() => tabContentExp.classList.remove('opacity-0'), 20);
        });

        tabBtnEdu.addEventListener('click', () => {
            tabBtnEdu.className = 'px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white transition-all shadow-sm';
            tabBtnExp.className = 'px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all';
            tabContentExp.classList.add('hidden', 'opacity-0');
            tabContentEdu.classList.remove('hidden');
            setTimeout(() => tabContentEdu.classList.remove('opacity-0'), 20);
        });
    }

    // 2. TESTIMONIAL SLIDER
    const slides = document.querySelectorAll('.testimonial-slide');
    const prevBtn = document.getElementById('prev-testimonial');
    const nextBtn = document.getElementById('next-testimonial');
    let currentSlide = 0;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.classList.remove('hidden');
                setTimeout(() => {
                    slide.classList.remove('opacity-0');
                    slide.classList.add('opacity-100');
                }, 20);
            } else {
                slide.classList.add('opacity-0');
                slide.classList.remove('opacity-100');
                setTimeout(() => slide.classList.add('hidden'), 200);
            }
        });
    }

    if (prevBtn && nextBtn && slides.length > 1) {
        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + slides.length) % slides.length;
            showSlide(currentSlide);
        });
        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        });
    }

    // 3. DEVICE-RESTRICTED TESTIMONIAL FORM
    const tForm = document.getElementById('testimonial-form');
    const tAlready = document.getElementById('testimonial-already-submitted');
    const tFingerprintInput = document.getElementById('device_fingerprint');
    const tMessage = document.getElementById('t-message');
    const tSubmitBtn = document.getElementById('t-submit-btn');

    // Generate or retrieve unique persistent Device ID
    let deviceId = localStorage.getItem('portfolio_device_id');
    if (!deviceId) {
        deviceId = 'dev_' + Math.random().toString(36).substring(2, 15) + '_' + Date.now();
        localStorage.setItem('portfolio_device_id', deviceId);
    }
    if (tFingerprintInput) {
        tFingerprintInput.value = deviceId;
    }

    // Check if this device has already submitted
    const isSubmitted = localStorage.getItem('portfolio_testimonial_submitted');
    if (isSubmitted === 'true' && tForm && tAlready) {
        tForm.classList.add('hidden');
        tAlready.classList.remove('hidden');
    }

    // Star rating picker
    const starBtns = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('t-rating');
    const ratingText = document.getElementById('rating-text');

    starBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const val = parseInt(btn.dataset.star);
            ratingInput.value = val;
            ratingText.innerText = val + ' dari 5 Bintang';
            starBtns.forEach((b, idx) => {
                b.innerText = (idx < val) ? '★' : '☆';
            });
        });
    });

    // Form submission via AJAX
    if (tForm) {
        tForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            tSubmitBtn.disabled = true;
            tSubmitBtn.innerText = 'Mengirimkan...';
            tMessage.classList.add('hidden');

            const formData = new FormData(tForm);

            try {
                const response = await fetch('{{ route("testimonials.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    localStorage.setItem('portfolio_testimonial_submitted', 'true');
                    tForm.classList.add('hidden');
                    tAlready.classList.remove('hidden');

                    alert('Terima kasih! Testimoni Anda berhasil dikirimkan.');
                    location.reload();
                } else {
                    tMessage.classList.remove('hidden');
                    tMessage.className = 'text-xs font-bold p-2.5 rounded-xl text-center bg-rose-100 text-rose-700';
                    tMessage.innerText = data.message || 'Terjadi kesalahan dalam mengirimkan testimoni.';
                    tSubmitBtn.disabled = false;
                    tSubmitBtn.innerText = 'Kirim Testimoni';
                }
            } catch (err) {
                tMessage.classList.remove('hidden');
                tMessage.className = 'text-xs font-bold p-2.5 rounded-xl text-center bg-rose-100 text-rose-700';
                tMessage.innerText = 'Gagal terhubung ke server. Silakan coba lagi.';
                tSubmitBtn.disabled = false;
                tSubmitBtn.innerText = 'Kirim Testimoni';
            }
        });
    }
});
</script>
@endsection
