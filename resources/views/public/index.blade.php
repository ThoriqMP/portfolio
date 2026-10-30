@extends('layouts.public')

@section('content')
<!-- Hero Section (Organic Paper Texture, Editorial Typography & Framed Portrait) -->
<section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-8 items-center">
            
            <!-- Left Column: Personal Introduction & Core Copy -->
            <div class="lg:col-span-5 space-y-6 text-center lg:text-left">
                <!-- Status Pill -->
                <div>
                    <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-semibold bg-paper-200 border border-paper-300 text-slate-800">
                        <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                        Tersedia untuk Proyek & Pekerjaan
                    </span>
                </div>

                <div class="space-y-1">
                    <span class="block text-xl sm:text-2xl font-bold text-slate-600">
                        Halo, Saya
                    </span>
                    <h1 class="text-5xl sm:text-6xl md:text-7xl font-extrabold tracking-tight text-slate-950 leading-none">
                        {{ $user->name ?? 'Muhammad Thoriq' }}
                    </h1>
                </div>

                <!-- Professional Title Badge -->
                <div>
                    <span class="inline-block px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-sm">
                        {{ $user->title ?? 'Fullstack Web Developer' }}
                    </span>
                </div>

                <!-- Authentic Bio (Grounded from Database) -->
                <p class="text-base sm:text-lg text-slate-700 leading-relaxed max-w-lg mx-auto lg:mx-0 font-normal">
                    {{ $user->bio ?? 'Pengembang web yang berfokus membangun aplikasi web modern, efisien, dan andal menggunakan ekosistem Laravel dan Tailwind CSS.' }}
                </p>

                <!-- Action Buttons -->
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-3">
                    <a href="#projects" class="inline-flex items-center gap-2 px-6 py-3 rounded-full bg-slate-900 hover:bg-accent-500 text-white text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm">
                        Lihat Portofolio Proyek
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <a href="#about" class="inline-flex items-center px-5 py-3 rounded-full border border-paper-300 hover:border-slate-800 bg-white/70 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 transition-colors">
                        Tentang Saya
                    </a>
                </div>
            </div>

            <!-- Middle Column: Framed Editorial Portrait -->
            <div class="lg:col-span-4 flex justify-center order-first lg:order-none">
                <div class="relative group">
                    <!-- Subtle paper frame overlay -->
                    <div class="paper-card p-3 bg-white shadow-[0_8px_30px_rgba(45,35,25,0.08)] transform rotate-1 group-hover:rotate-0 transition-all duration-300">
                        <div class="w-64 h-80 sm:w-72 sm:h-92 overflow-hidden rounded-2xl bg-paper-200 flex items-center justify-center">
                            @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                                <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-paper-200 flex flex-col items-center justify-center text-slate-400">
                                    <span class="text-5xl font-black text-accent-500">{{ substr($user->name, 0, 1) }}</span>
                                    <span class="text-xs uppercase font-bold mt-2 text-slate-500">{{ $user->name }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="pt-3 pb-1 text-center">
                            <span class="text-xs font-bold text-slate-900 tracking-tight block">{{ $user->name }}</span>
                            <span class="text-[10px] font-medium text-slate-500 block uppercase tracking-wider">{{ $user->title ?? 'Web Developer' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Connect & Technical Focus Summary -->
            <div class="lg:col-span-3 flex flex-col justify-between space-y-8 text-center lg:text-left">
                <!-- Social Connect -->
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">
                        Media & Kontak
                    </span>
                    <div class="flex items-center justify-center lg:justify-start gap-2">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks->take(4) as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-150" title="{{ $social->name }}">
                                    <span class="text-xs font-bold uppercase">{{ substr($social->name, 0, 2) }}</span>
                                </a>
                            @endforeach
                        @else
                            @if ($user->github_link ?? true)
                                <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-150" title="GitHub">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                                </a>
                            @endif
                            @if ($user->linkedin_link ?? true)
                                <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-150" title="LinkedIn">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                                </a>
                            @endif
                            @if ($user->instagram_link ?? true)
                                <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-150" title="Instagram">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>

                <!-- Grounded Focus Highlights Card -->
                <div class="p-4 bg-white/60 border border-paper-300 rounded-2xl text-left space-y-2">
                    <span class="text-xs font-bold text-slate-800 block">Fokus Utama</span>
                    <ul class="space-y-1.5 text-xs text-slate-600">
                        <li class="flex items-center gap-1.5">
                            <span class="text-accent-500 font-bold">&#10003;</span>
                            Fullstack Web (Laravel & MySQL)
                        </li>
                        <li class="flex items-center gap-1.5">
                            <span class="text-accent-500 font-bold">&#10003;</span>
                            Antarmuka Responsif (Tailwind CSS)
                        </li>
                        <li class="flex items-center gap-1.5">
                            <span class="text-accent-500 font-bold">&#10003;</span>
                            RESTful API & Integrasi Layanan
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats / Metrics Strip (Real & Grounded) -->
<section class="py-10 bg-white border-y border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-paper-300">
            <!-- Stat 1: Pengalaman Kerja -->
            <div class="pt-3 md:pt-0">
                <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight block">
                    {{ $user->years_experience ?? '2+ Tahun' }}
                </span>
                <span class="text-xs font-semibold text-slate-500 mt-1 block uppercase tracking-wider">
                    Pengalaman Praktis
                </span>
            </div>

            <!-- Stat 2: Proyek Selesai -->
            <div class="pt-3 md:pt-0">
                <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight block">
                    {{ $user->projects_completed ?? ($user->projects->count() > 0 ? $user->projects->count() . ' Proyek' : '3+ Proyek') }}
                </span>
                <span class="text-xs font-semibold text-slate-500 mt-1 block uppercase tracking-wider">
                    Proyek Selesai
                </span>
            </div>

            <!-- Stat 3: Tech Stack -->
            <div class="pt-3 md:pt-0">
                <span class="text-3xl sm:text-4xl font-extrabold text-slate-900 tracking-tight block">
                    {{ $user->badges && $user->badges->count() > 0 ? $user->badges->count() . ' Tech' : '6+ Tech' }}
                </span>
                <span class="text-xs font-semibold text-slate-500 mt-1 block uppercase tracking-wider">
                    Teknologi Dikuasai
                </span>
            </div>

            <!-- Stat 4: Status Kesiapan -->
            <div class="pt-3 md:pt-0">
                <span class="text-3xl sm:text-4xl font-extrabold text-accent-500 tracking-tight block">
                    {{ $user->support_available ?? 'Tersedia' }}
                </span>
                <span class="text-xs font-semibold text-slate-500 mt-1 block uppercase tracking-wider">
                    Kesiapan Kerja / Proyek
                </span>
            </div>
        </div>
    </div>
</section>

<!-- About Section ("Tentang Saya") -->
<section id="about" class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <!-- Left: About Photo / Code Workspace Mockup -->
            <div class="lg:col-span-5">
                <div class="paper-card p-3 bg-white">
                    @if ($user->about_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->about_image_path))
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-paper-200">
                            <img src="{{ asset('storage/' . $user->about_image_path) }}" 
                                 alt="Tentang {{ $user->name }}" 
                                 class="w-full h-full object-cover">
                        </div>
                    @else
                        <!-- Clean Developer Workspace / Code Editor Card -->
                        <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-slate-900 p-6 flex flex-col justify-between text-slate-300 font-mono text-xs">
                            <div class="flex items-center gap-2 pb-3 border-b border-slate-800">
                                <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span class="text-[11px] text-slate-400 font-sans ml-2">DeveloperProfile.php</span>
                            </div>
                            <div class="space-y-1.5 py-4 leading-relaxed">
                                <p><span class="text-purple-400">class</span> <span class="text-amber-300">{{ explode(' ', $user->name)[0] }}</span> <span class="text-purple-400">extends</span> <span class="text-blue-300">Developer</span> {</p>
                                <p class="pl-4"><span class="text-slate-500">// Stack: Laravel, Tailwind, MySQL</span></p>
                                <p class="pl-4"><span class="text-purple-400">public function</span> <span class="text-blue-400">buildSolutions</span>() {</p>
                                <p class="pl-8 text-emerald-400">return $cleanCode && $highPerformance;</p>
                                <p class="pl-4">}</p>
                                <p>}</p>
                            </div>
                            <div class="text-[10px] text-slate-500 pt-2 border-t border-slate-800">
                                // Status: Ready for collaboration
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right: About Editorial & Badges -->
            <div class="lg:col-span-7 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-accent-500 mb-2 inline-block">
                        TENTANG SAYA
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        {{ $user->about_title ?? 'Fokus Pada Solusi Nyata & Kualitas Kode' }}
                    </h2>
                </div>

                <div class="text-sm sm:text-base text-slate-700 leading-relaxed space-y-4">
                    @if ($user->about_description)
                        <p class="whitespace-pre-line">{{ $user->about_description }}</p>
                    @else
                        <p>
                            {{ $user->bio ?? 'Saya adalah lulusan Teknik Informatika yang berdedikasi dalam membangun aplikasi web fungsional dan berkinerja stabil.' }}
                        </p>
                        <p>
                            Pendekatan kerja saya menitikberatkan pada kerapian struktur kode, kepatuhan terhadap standar industri, serta kemudahan bagi pengguna akhir saat berinteraksi dengan aplikasi.
                        </p>
                    @endif
                </div>

                <!-- Badges Highlights from Database -->
                @if ($user->badges && $user->badges->count() > 0)
                    <div class="pt-2">
                        <span class="block text-xs font-bold uppercase tracking-wider text-slate-500 mb-2.5">Keahlian & Teknologi:</span>
                        <div class="flex flex-wrap gap-2">
                            @foreach ($user->badges as $badge)
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border shadow-2xs"
                                      style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.06);">
                                    {{ $badge->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
</section>

<!-- Services / Keahlian Section (Clean Technical Capabilities) -->
<section id="services" class="py-20 md:py-28 bg-paper-warm border-y border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-2xl mb-14 space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-accent-600 block">
                KEAHLIAN & LAYANAN
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                Solusi Rekayasa Web End-to-End
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Menangani pengembangan web secara komprehensif, mulai dari logika backend yang aman hingga antarmuka pengguna yang bersih dan mudah digunakan.
            </p>
        </div>

        <!-- Capability Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <!-- Card 1: Frontend -->
            <div class="paper-card p-6 flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center font-bold text-sm mb-4 border border-accent-200">
                        01
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                        Frontend & UI
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Membangun antarmuka web responsif dan interaktif menggunakan Tailwind CSS, Blade template, dan JavaScript modern yang ramah pengguna.
                    </p>
                </div>
            </div>

            <!-- Card 2: Backend & API -->
            <div class="paper-card p-6 flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center font-bold text-sm mb-4 border border-accent-200">
                        02
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                        Backend & REST API
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Implementasi arsitektur MVC berbasis Laravel, autentikasi teruji, pengelolaan sesi, dan pembuatan endpoint API terstruktur.
                    </p>
                </div>
            </div>

            <!-- Card 3: Database MySQL -->
            <div class="paper-card p-6 flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center font-bold text-sm mb-4 border border-accent-200">
                        03
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                        Database & Query
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Perancangan skema relasional MySQL, optimasi relasi Eloquent ORM, indexing, dan pencegahan masalah N+1 query.
                    </p>
                </div>
            </div>

            <!-- Card 4: Keamanan & Integrasi -->
            <div class="paper-card p-6 flex flex-col justify-between">
                <div>
                    <div class="w-10 h-10 rounded-xl bg-accent-50 text-accent-600 flex items-center justify-center font-bold text-sm mb-4 border border-accent-200">
                        04
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">
                        Keamanan & Integrasi
                    </h3>
                    <p class="text-xs sm:text-sm text-slate-600 leading-relaxed">
                        Penerapan proteksi CSRF, sanitasi input data, integrasi payment gateway / modul pihak ketiga, dan manajemen versioning Git.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Experience & Education Section (Tabs with Paper Texture) -->
<section id="experience" class="py-20 md:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header with Tab Toggles for Experiences & Educations -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    RIWAYAT
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                    Pengalaman & Pendidikan
                </h2>
            </div>

            <!-- Tab Buttons -->
            <div class="flex items-center gap-2 p-1.5 bg-paper-200 rounded-full border border-paper-300">
                <button type="button" id="tab-btn-exp" class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white transition-all shadow-sm">
                    Pengalaman Kerja ({{ $user->experiences->count() }})
                </button>
                <button type="button" id="tab-btn-edu" class="px-5 py-2 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all">
                    Pendidikan ({{ $user->educations->count() }})
                </button>
            </div>
        </div>

        <!-- 1. Experience List Container -->
        <div id="tab-content-exp" class="transition-opacity duration-300">
            <div class="divide-y divide-paper-300 border-y border-paper-300">
                @forelse ($user->experiences as $exp)
                    <div class="py-6 px-4 rounded-2xl hover:bg-white/80 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <!-- Period / Year -->
                            <div class="w-full sm:w-44 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500">
                                    {{ $exp->start_date ? $exp->start_date->format('M Y') : '2023' }} &mdash; 
                                    {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Sekarang' }}
                                </span>
                            </div>

                            <!-- Role / Title -->
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $exp->position }}
                                </h3>
                                <span class="text-xs font-semibold text-accent-600 block mt-0.5">
                                    {{ $exp->company_name }}
                                </span>
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
                                        <p class="text-xs sm:text-sm text-slate-600 mt-1.5 max-w-xl whitespace-pre-line">
                                            {{ $exp->description }}
                                        </p>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-500 text-sm font-medium">
                        Belum ada riwayat pengalaman kerja yang ditambahkan.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 2. Education List Container -->
        <div id="tab-content-edu" class="hidden opacity-0 transition-opacity duration-300">
            <div class="divide-y divide-paper-300 border-y border-paper-300">
                @forelse ($user->educations as $edu)
                    <div class="py-6 px-4 rounded-2xl hover:bg-white/80 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                            <div class="w-full sm:w-44 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500">
                                    {{ $edu->start_year }} &mdash; {{ $edu->end_year ?? 'Sekarang' }}
                                </span>
                            </div>

                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $edu->degree }}
                                </h3>
                                <span class="text-xs font-semibold text-accent-600 block mt-0.5">
                                    {{ $edu->institution_name }}
                                </span>
                                @if ($edu->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-1.5 max-w-xl whitespace-pre-line">
                                        {{ $edu->description }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="py-8 text-center text-slate-500 text-sm font-medium">
                        Belum ada data riwayat pendidikan akademik.
                    </div>
                @endforelse
            </div>
        </div>

    </div>
</section>

<!-- Portfolio / Projects Section -->
<section id="projects" class="py-20 md:py-28 bg-white border-t border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-14">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    PORTOFOLIO
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                    Proyek Pilihan
                </h2>
            </div>
            <p class="text-sm text-slate-600 max-w-md leading-relaxed">
                Studi kasus aplikasi web riil yang telah dikembangkan, mencakup sistem informasi, aplikasi internal, dan portal interaktif.
            </p>
        </div>

        <!-- Projects Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @forelse ($user->projects as $project)
                @php
                    $imgSrc = ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path)) 
                        ? asset('storage/' . $project->image_path) 
                        : null;
                @endphp

                <div class="paper-card overflow-hidden group flex flex-col justify-between">
                    <!-- Project Thumbnail -->
                    <div class="aspect-video w-full overflow-hidden bg-slate-100 relative border-b border-paper-300">
                        @if ($imgSrc)
                            <img src="{{ $imgSrc }}" 
                                 alt="{{ $project->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-103 transition-transform duration-500">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center p-6 text-slate-400 bg-paper-warm">
                                <span class="text-xs uppercase font-bold tracking-wider">// Tangkapan Layar Proyek</span>
                                <span class="text-sm font-semibold text-slate-600 mt-1">{{ $project->title }}</span>
                            </div>
                        @endif
                    </div>

                    <!-- Project Details -->
                    <div class="p-6 sm:p-7 space-y-4 flex-grow flex flex-col justify-between">
                        <div class="space-y-2">
                            <!-- Badges -->
                            @if($project->badges && $project->badges->count() > 0)
                                <div class="flex flex-wrap gap-1.5 pb-1">
                                    @foreach($project->badges as $badge)
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider border"
                                              style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.06);">
                                            {{ $badge->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                <a href="{{ route('projects.show', $project->id) }}">{{ $project->title }}</a>
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 leading-relaxed line-clamp-2">
                                {{ $project->description }}
                            </p>
                        </div>

                        <!-- Actions -->
                        <div class="pt-4 border-t border-paper-300 flex items-center justify-between text-xs font-semibold">
                            <a href="{{ route('projects.show', $project->id) }}" class="text-slate-900 hover:text-accent-500 inline-flex items-center gap-1.5 transition-colors">
                                Detail Studi Kasus &rarr;
                            </a>

                            @if($project->project_link)
                                <a href="{{ $project->project_link }}" target="_blank" rel="noopener noreferrer" class="text-accent-500 hover:underline">
                                    Kunjungi Live
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-slate-500 text-sm font-medium">
                    Belum ada portofolio proyek yang ditambahkan.
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Testimonials Section (Organic Visitor Reviews + Device Restriction) -->
<section id="testimonials" class="py-20 md:py-28 bg-paper-warm border-t border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="max-w-2xl mb-12 space-y-2">
            <span class="text-xs font-bold uppercase tracking-wider text-accent-600 block">
                TESTIMONI PENGUNJUNG
            </span>
            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-950 tracking-tight">
                Ulasan & Kesan Pengalaman
            </h2>
            <p class="text-sm text-slate-600 leading-relaxed">
                Tanggapan langsung dari mereka yang pernah bekerja sama atau meninjau portofolio ini. Dibatasi 1 ulasan per perangkat.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left Column: Testimonials Display Carousel (7 cols) -->
            <div class="lg:col-span-7 paper-card p-8 sm:p-10 relative">
                <div class="text-accent-500 text-4xl font-serif font-black leading-none mb-4 select-none">
                    &ldquo;
                </div>

                <!-- Testimonials List -->
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
                                    <p class="text-base sm:text-lg font-semibold text-slate-800 leading-relaxed">
                                        &ldquo;{{ $t->content }}&rdquo;
                                    </p>

                                    <!-- Author Info -->
                                    <div class="pt-2 flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-full bg-accent-500 text-white font-bold flex items-center justify-center text-xs">
                                            {{ substr($t->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <span class="block text-sm font-bold text-slate-900">{{ $t->name }}</span>
                                            <span class="block text-xs text-slate-500">
                                                {{ $t->role }}{{ $t->company ? ' &bull; ' . $t->company : '' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Welcoming placeholder -->
                        <div class="py-6 text-center space-y-2">
                            <p class="text-sm sm:text-base font-semibold text-slate-700">
                                Belum ada testimoni pengunjung yang masuk.
                            </p>
                            <p class="text-xs text-slate-500">
                                Jadilah orang pertama yang meninggalkan pesan apresiasi melalui form di samping!
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Slider Controls if multiple testimonials -->
                @if ($testimonials && $testimonials->count() > 1)
                    <div class="flex items-center justify-end gap-2 pt-6 border-t border-paper-300 mt-6">
                        <button id="prev-testimonial" type="button" class="w-8 h-8 rounded-full border border-paper-300 hover:border-slate-800 text-slate-700 flex items-center justify-center transition-colors" aria-label="Previous">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                        </button>
                        <button id="next-testimonial" type="button" class="w-8 h-8 rounded-full bg-accent-500 hover:bg-accent-600 text-white flex items-center justify-center shadow-sm transition-colors" aria-label="Next">
                            <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" /></svg>
                        </button>
                    </div>
                @endif
            </div>

            <!-- Right Column: Form Input (5 cols) -->
            <div class="lg:col-span-5 paper-card p-6 sm:p-7">
                <!-- Already Submitted State Card -->
                <div id="testimonial-already-submitted" class="hidden p-6 bg-accent-50/70 border border-accent-200 rounded-2xl space-y-3 text-center">
                    <div class="w-10 h-10 rounded-full bg-accent-500 text-white flex items-center justify-center mx-auto shadow-sm">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h3 class="text-sm font-bold text-slate-900">Testimoni Anda Telah Diterima!</h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Perangkat Anda telah mengirimkan ulasan untuk portofolio ini. Terima kasih banyak atas masukan dan apresiasi Anda.
                    </p>
                </div>

                <!-- Input Form -->
                <form id="testimonial-form" class="space-y-3.5">
                    @csrf
                    <input type="hidden" name="device_fingerprint" id="device_fingerprint">

                    <div>
                        <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block mb-0.5">
                            Formulir Ulasan
                        </span>
                        <h3 class="text-lg font-bold text-slate-900">
                            Tinggalkan Pesan Testimoni
                        </h3>
                    </div>

                    <!-- Name -->
                    <div>
                        <label for="t-name" class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                        <input type="text" name="name" id="t-name" required placeholder="Nama Anda"
                            class="w-full bg-paper-100 border border-paper-300 rounded-xl px-3 py-2 text-xs sm:text-sm focus:outline-none focus:border-accent-500 focus:bg-white transition-colors">
                    </div>

                    <!-- Role & Company Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                        <div>
                            <label for="t-role" class="block text-xs font-semibold text-slate-700 mb-1">Peran / Hubungan *</label>
                            <input type="text" name="role" id="t-role" required placeholder="Contoh: Klien / Rekan Tim"
                                class="w-full bg-paper-100 border border-paper-300 rounded-xl px-3 py-2 text-xs sm:text-sm focus:outline-none focus:border-accent-500 focus:bg-white transition-colors">
                        </div>
                        <div>
                            <label for="t-company" class="block text-xs font-semibold text-slate-700 mb-1">Instansi (Opsional)</label>
                            <input type="text" name="company" id="t-company" placeholder="Nama Perusahaan"
                                class="w-full bg-paper-100 border border-paper-300 rounded-xl px-3 py-2 text-xs sm:text-sm focus:outline-none focus:border-accent-500 focus:bg-white transition-colors">
                        </div>
                    </div>

                    <!-- Star Rating Selector -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 mb-1">Rating Kepuasan</label>
                        <div class="flex items-center gap-1.5" id="star-selector">
                            <input type="hidden" name="rating" id="t-rating" value="5">
                            <button type="button" data-star="1" class="star-btn text-lg text-accent-500">★</button>
                            <button type="button" data-star="2" class="star-btn text-lg text-accent-500">★</button>
                            <button type="button" data-star="3" class="star-btn text-lg text-accent-500">★</button>
                            <button type="button" data-star="4" class="star-btn text-lg text-accent-500">★</button>
                            <button type="button" data-star="5" class="star-btn text-lg text-accent-500">★</button>
                            <span id="rating-text" class="text-xs font-medium text-slate-500 ml-2">5 dari 5 Bintang</span>
                        </div>
                    </div>

                    <!-- Testimonial Content -->
                    <div>
                        <label for="t-content" class="block text-xs font-semibold text-slate-700 mb-1">Pesan Ulasan *</label>
                        <textarea name="content" id="t-content" rows="3" required placeholder="Tuliskan kesan atau pengalaman Anda..."
                            class="w-full bg-paper-100 border border-paper-300 rounded-xl px-3 py-2 text-xs sm:text-sm focus:outline-none focus:border-accent-500 focus:bg-white transition-colors"></textarea>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" id="t-submit-btn" class="w-full py-2.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-xs sm:text-sm shadow-sm transition-colors">
                            Kirim Testimoni
                        </button>
                    </div>

                    <div id="t-message" class="hidden text-xs font-semibold p-2.5 rounded-xl text-center"></div>
                </form>

            </div>

        </div>
    </div>
</section>

<!-- Call to Action Banner (Clean Paper Craft) -->
<section class="py-16 md:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="paper-card bg-paper-warm border border-paper-300 p-8 sm:p-12 md:p-14">
            <div class="max-w-2xl space-y-4">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-600 block">
                    DISKUSI TERBUKA
                </span>
                <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Punya Rencana atau Kebutuhan Proyek Web?
                </h2>
                <p class="text-sm sm:text-base text-slate-600 leading-relaxed font-normal">
                    Mari diskusikan ide aplikasi, perancangan sistem, maupun kebutuhan pengembang web untuk tim Anda. Saya terbuka untuk proyek freelance, kontrak, maupun kerja sama tim.
                </p>
                <div class="pt-2">
                    <a href="mailto:{{ $user->email_contact ?? 'hi@getincontact.com' }}" class="inline-flex items-center gap-2 px-7 py-3 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-sm shadow-sm transition-colors">
                        Mulai Diskusi &rarr;
                    </a>
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

    let deviceId = localStorage.getItem('portfolio_device_id');
    if (!deviceId) {
        deviceId = 'dev_' + Math.random().toString(36).substring(2, 15) + '_' + Date.now();
        localStorage.setItem('portfolio_device_id', deviceId);
    }
    if (tFingerprintInput) {
        tFingerprintInput.value = deviceId;
    }

    const isSubmitted = localStorage.getItem('portfolio_testimonial_submitted');
    if (isSubmitted === 'true' && tForm && tAlready) {
        tForm.classList.add('hidden');
        tAlready.classList.remove('hidden');
    }

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
                    tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                    tMessage.innerText = data.message || 'Terjadi kesalahan dalam mengirimkan testimoni.';
                    tSubmitBtn.disabled = false;
                    tSubmitBtn.innerText = 'Kirim Testimoni';
                }
            } catch (err) {
                tMessage.classList.remove('hidden');
                tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                tMessage.innerText = 'Gagal terhubung ke server. Silakan coba lagi.';
                tSubmitBtn.disabled = false;
                tSubmitBtn.innerText = 'Kirim Testimoni';
            }
        });
    }
});
</script>
@endsection
