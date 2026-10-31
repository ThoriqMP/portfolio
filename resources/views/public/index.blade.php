@extends('layouts.public')

@section('content')
<!-- Hero Section (Organic Paper Texture, 3-Column Mockup Composition & Ambient Warmth) -->
<section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden">
    <!-- Soft Reddish-Orange Ambient Glow (No Grid Lines) -->
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] h-[350px] bg-accent-400/10 blur-[120px] rounded-full pointer-events-none -z-0"></div>

    <!-- Giant Faint Background Watermark: Title from Mockup -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 select-none text-[6rem] sm:text-[9rem] md:text-[13rem] lg:text-[16rem] font-black text-slate-900/[0.03] uppercase tracking-tighter pointer-events-none z-0 whitespace-nowrap">
        {{ strtoupper($user->title ?? 'BRAND DESIGNER') }}
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center">
            
            <!-- Left Column: Typographic Hero & Intro (Exact Mockup Alignment) -->
            <div class="lg:col-span-4 space-y-5 text-center lg:text-left">
                <div class="space-y-1">
                    <span class="block text-2xl sm:text-3xl font-extrabold uppercase tracking-tight text-slate-800">
                        I'M
                    </span>
                    <h1 class="text-6xl sm:text-7xl md:text-8xl font-black italic tracking-tighter text-slate-950 leading-none">
                        {{ explode(' ', $user->name ?? 'Ethan')[0] }}
                    </h1>
                </div>

                <!-- Stylized Title Pill -->
                <div>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] sm:text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-sm shadow-accent-500/30">
                        {{ $user->title ?? 'DIGITAL PRODUCT DESIGNER' }}
                    </span>
                </div>

                <!-- Bio / Intro Copy -->
                <p class="text-sm sm:text-base font-normal text-slate-600 leading-relaxed max-w-md mx-auto lg:mx-0">
                    {{ $user->bio ?? 'Creating meaningful digital products that drive engagement, solve complex business problems, and elevate human experiences.' }}
                </p>

                <!-- Quick Action Buttons -->
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-3">
                    <a href="#projects" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-slate-900 hover:bg-accent-500 text-white text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm">
                        Explore Work
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <a href="#about" class="inline-flex items-center px-5 py-2.5 rounded-full border border-paper-300 hover:border-slate-800 bg-white/70 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 transition-colors">
                        About Me
                    </a>
                </div>
            </div>

            <!-- Middle Column: Portrait Cutout Photo Matching Mockup -->
            <div class="lg:col-span-4 flex justify-center order-first lg:order-none">
                <div class="relative w-64 h-80 sm:w-80 sm:h-96 md:w-96 md:h-[430px] flex items-end justify-center">
                    <!-- Subtle ambient warmth behind portrait -->
                    <div class="absolute inset-0 bg-gradient-to-t from-accent-500/15 to-transparent rounded-full blur-2xl -z-10"></div>

                    @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                        <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover object-top rounded-3xl drop-shadow-2xl">
                    @else
                        <!-- High Fidelity Designer Portrait Matching Mockup -->
                        <div class="relative w-full h-full overflow-hidden rounded-3xl group">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=900&q=80" 
                                 alt="{{ $user->name ?? 'Ethan Ward' }}" 
                                 class="w-full h-full object-cover object-top drop-shadow-2xl filter contrast-[1.02] brightness-[1.02]">
                            <!-- Soft subtle bottom gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-white/20 via-transparent to-transparent"></div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Right Column: Follow Me Socials & Big Display Label (Exact Mockup) -->
            <div class="lg:col-span-4 flex flex-col justify-between h-full space-y-12 lg:space-y-24 text-center lg:text-left">
                <!-- Top: Follow Me Socials -->
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block">
                        Follow me
                    </span>
                    <div class="flex items-center justify-center lg:justify-start gap-2.5">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks->take(4) as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center shadow-xs transition-all duration-200" title="{{ $social->name }}">
                                    <span class="text-xs font-bold uppercase">{{ substr($social->name, 0, 2) }}</span>
                                </a>
                            @endforeach
                        @else
                            <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="LinkedIn">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                            </a>
                            <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="GitHub">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                            </a>
                            <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="Instagram">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                            </a>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500 max-w-xs mx-auto lg:mx-0 leading-relaxed">
                        I design intuitive and visually stunning user experiences for modern products.
                    </p>
                </div>

                <!-- Bottom: Big Display Label Stacked (Exact Mockup) -->
                @php
                    $titleWords = explode(' ', $user->title ?? 'DIGITAL PRODUCT DESIGNER');
                @endphp
                <div class="pt-4 lg:pt-0 hidden lg:block text-right">
                    <h2 class="text-3xl xl:text-4xl 2xl:text-5xl font-black uppercase tracking-tight text-slate-900 leading-none">
                        @foreach ($titleWords as $word)
                            <span class="block">{{ $word }}</span>
                        @endforeach
                    </h2>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Section ("Designing with Purpose, Building with Passion") -->
<section id="about" class="py-20 md:py-28 bg-white border-y border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left: High Quality Workplace Photo Card -->
            <div class="lg:col-span-6">
                <div class="relative overflow-hidden rounded-3xl shadow-[0_15px_35px_rgba(0,0,0,0.06)] border border-paper-300 aspect-[4/3] group bg-paper-100">
                    @if ($user->about_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->about_image_path))
                        <img src="{{ asset('storage/' . $user->about_image_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=1200&q=80" 
                             alt="Designing with Purpose" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @endif
                </div>
            </div>

            <!-- Right: About Editorial & CTA -->
            <div class="lg:col-span-6 space-y-6">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-accent-500 mb-2 inline-flex items-center gap-2">
                        <span class="w-4 h-0.5 bg-accent-500"></span>
                        ABOUT ME
                    </span>
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        {{ $user->about_title ?? 'Designing with Purpose, Building with Passion' }}
                    </h2>
                </div>

                <div class="text-sm sm:text-base text-slate-600 leading-relaxed space-y-4 font-normal">
                    @if ($user->about_description)
                        <p class="whitespace-pre-line">{{ $user->about_description }}</p>
                    @else
                        <p>
                            With over a decade of design and development experience, I bridge the gap between creative aesthetics and high-performance engineering. Every interface I build begins with an in-depth understanding of user needs, functional clarity, and business outcomes.
                        </p>
                        <p>
                            Whether architecting scalable design systems, crafting intuitive mobile workflows, or designing responsive web applications, my mission is to deliver digital experiences that leave a lasting impression.
                        </p>
                    @endif
                </div>

                <!-- Badges Highlights from Database (if available) -->
                @if ($user->badges && $user->badges->count() > 0)
                    <div class="pt-2">
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

                <div class="pt-2">
                    <a href="#services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-sm font-semibold shadow-md shadow-accent-500/25 hover:shadow-lg hover:shadow-accent-500/35 transition-all">
                        Read More
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats / Metrics Strip (4 Horizontal Metrics matching Mockup) -->
<section class="py-12 md:py-16 bg-white border-b border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-paper-300">
            <!-- Stat 1: Years Experience -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->years_experience ?? '10+' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Years Experience
                </span>
            </div>

            <!-- Stat 2: Projects Completed -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->projects_completed ?? (max(109, ($user->projects->count() > 0 ? $user->projects->count() * 12 : 109)) . '+') }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Project Completed
                </span>
            </div>

            <!-- Stat 3: Support Available -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->support_available ?? '20/7' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Support Available
                </span>
            </div>

            <!-- Stat 4: Client Satisfaction -->
            <div class="pt-4 md:pt-0">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block">
                    {{ $user->client_satisfaction ?? '96%' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Client Satisfaction
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Services / Bento Grid Section (Exact 6-Item Mockup Layout) -->
<section id="services" class="py-24 md:py-32 bg-paper-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    SERVICES
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Designing digital solutions that empower your visions
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                Focused on delivering results that drive engagement, boost conversions, and elevate brands to the highest industry standards.
            </p>
        </div>

        <!-- 6-Item Bento Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            
            <!-- Card 01: UI/UX Design -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        01
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        UI/UX Design
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Designing intuitive, user-centered digital interfaces that solve complex problems and deliver seamless, delight-inducing user journeys.
                    </p>
                </div>
            </div>

            <!-- Card 02: Web Design -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        02
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Web Design
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Crafting beautiful, responsive, and performance-focused websites that captivate audiences, convey brand trust, and drive conversions.
                    </p>
                </div>
            </div>

            <!-- Bento Visual Showcase 1: Smartphone In Hand Mockup -->
            <div class="overflow-hidden rounded-3xl border border-paper-300 shadow-sm aspect-[4/3] md:aspect-auto group bg-white">
                @if ($user->bento_image_1 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_1))
                    <img src="{{ asset('storage/' . $user->bento_image_1) }}" 
                         alt="Mobile App Mockup" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80" 
                         alt="Mobile App Mockup" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @endif
            </div>

            <!-- Bento Visual Showcase 2: Streetwear / Brand Print Graphic -->
            <div class="overflow-hidden rounded-3xl border border-paper-300 shadow-sm aspect-[4/3] md:aspect-auto group bg-white">
                @if ($user->bento_image_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_2))
                    <img src="{{ asset('storage/' . $user->bento_image_2) }}" 
                         alt="Brand Graphic Hoodie" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @else
                    <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=800&q=80" 
                         alt="Brand Graphic Hoodie" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                @endif
            </div>

            <!-- Card 03: Graphic Design -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        03
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Graphic Design
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Creating memorable visual identities, brand guidelines, typography systems, and high-impact marketing collateral.
                    </p>
                </div>
            </div>

            <!-- Card 04: Design System -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 transition-colors block mb-6">
                        04
                    </span>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-accent-500 transition-colors">
                        Design System
                    </h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Building scalable, modular UI component libraries, tokens, and documentation that ensure seamless consistency across all products.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Experience Section ("Exploring My Growth as a Designer" with Paper Warm Texture, No Grids) -->
<section id="experience" class="py-24 md:py-32 bg-paper-warm border-y border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-600 block">
                    EXPERIENCE
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Exploring My Growth<br>as a Designer
                </h2>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <p class="text-sm text-slate-600 max-w-md leading-relaxed">
                    A chronicle of hands-on experience and professional evolution across creative agencies, fast-growing tech studios, and independent ventures.
                </p>

                <!-- Work & Education Tab Switcher -->
                <div class="flex items-center gap-1 bg-white/80 backdrop-blur-sm p-1 rounded-full border border-paper-300 self-start sm:self-auto shrink-0 shadow-2xs">
                    <button id="tab-btn-exp" type="button" class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-xs transition-all">
                        Work Experience
                    </button>
                    <button id="tab-btn-edu" type="button" class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all">
                        Education
                    </button>
                </div>
            </div>
        </div>

        <!-- Work Experience List Container -->
        <div id="tab-content-exp" class="divide-y divide-paper-300 border-y border-paper-300 transition-opacity duration-300">
            @if ($user->experiences && $user->experiences->count() > 0)
                @foreach ($user->experiences as $exp)
                    <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                            <!-- Period / Year -->
                            <div class="w-full sm:w-48 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                                    {{ $exp->start_date ? $exp->start_date->format('Y') : '2023' }} &mdash; 
                                    {{ $exp->end_date ? $exp->end_date->format('Y') : 'Present' }}
                                </span>
                            </div>

                            <!-- Role / Title -->
                            <div class="flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $exp->position }}
                                </h3>
                                @if ($exp->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl line-clamp-2">
                                        {{ is_array(json_decode($exp->description, true)) ? implode(' &bull; ', json_decode($exp->description, true)) : $exp->description }}
                                    </p>
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
                @endforeach
            @else
                <!-- Mockup-Accurate Fallback Preset Rows -->
                <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                        <span class="w-full sm:w-48 text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                            2023 &mdash; Present
                        </span>
                        <h3 class="flex-1 text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                            Senior UI/UX Designer
                        </h3>
                        <span class="sm:text-right text-sm sm:text-base font-bold text-slate-800">
                            Odama Studio
                        </span>
                    </div>
                </div>

                <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                        <span class="w-full sm:w-48 text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                            2022 &mdash; 2023
                        </span>
                        <div class="flex-1">
                            <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                Product Designer
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                                Led user research and iterative prototyping for cross-platform applications and design system maintenance.
                            </p>
                        </div>
                        <span class="sm:text-right text-sm sm:text-base font-bold text-slate-800">
                            Voltrans Studio
                        </span>
                    </div>
                </div>

                <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                        <span class="w-full sm:w-48 text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                            2021 &mdash; 2022
                        </span>
                        <h3 class="flex-1 text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                            Graphic Designer
                        </h3>
                        <span class="sm:text-right text-sm sm:text-base font-bold text-slate-800">
                            Kanota Studio
                        </span>
                    </div>
                </div>

                <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                        <span class="w-full sm:w-48 text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                            2020 &mdash; 2021
                        </span>
                        <h3 class="flex-1 text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                            Web Developer
                        </h3>
                        <span class="sm:text-right text-sm sm:text-base font-bold text-slate-800">
                            Peluru Studio
                        </span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Education List Container (Hidden by default, activated via tab) -->
        <div id="tab-content-edu" class="divide-y divide-paper-300 border-y border-paper-300 hidden opacity-0 transition-opacity duration-300">
            @if ($user->educations && $user->educations->count() > 0)
                @foreach ($user->educations as $edu)
                    <div class="py-6 sm:py-8 px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 sm:gap-6">
                            <span class="w-full sm:w-48 text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider">
                                {{ $edu->start_year }} &mdash; {{ $edu->end_year ?? 'Selesai' }}
                            </span>
                            <div class="flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors">
                                    {{ $edu->degree }} &bull; {{ $edu->major }}
                                </h3>
                                @if ($edu->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-xl">
                                        {{ $edu->description }}
                                    </p>
                                @endif
                            </div>
                            <span class="sm:text-right text-sm sm:text-base font-bold text-slate-800">
                                {{ $edu->institution_name }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="py-8 text-center text-slate-500 text-sm">
                    Belum ada riwayat pendidikan yang ditambahkan.
                </div>
            @endif
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
                    Bringing Ideas to Life<br>through Design
                </h2>
            </div>
            <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                Selected featured projects spanning mobile products, full-stack web applications, brand identities, and editorial packaging.
            </p>
        </div>

        <!-- 2x2 Grid of Rounded Project Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 lg:gap-10">
            @if ($user->projects && $user->projects->count() > 0)
                @foreach ($user->projects as $index => $project)
                    @php
                        // Fallback image curation if project has no uploaded image
                        $presetImages = [
                            'https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=1000&q=80',
                            'https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=1000&q=80',
                        ];
                        $imgSrc = ($project->image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($project->image_path)) 
                            ? asset('storage/' . $project->image_path) 
                            : ($presetImages[$index % 4]);
                        $yearBadge = 2024 - ($index % 3);
                    @endphp

                    <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl transition-all duration-300">
                        <!-- Project Image with Zoom on Hover -->
                        <img src="{{ $imgSrc }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                        <!-- Dark Bottom Vignette Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>

                        <!-- Card Content Overlay -->
                        <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                            <!-- Top Link Arrow Button -->
                            <div class="flex justify-end">
                                <a href="{{ route('projects.show', $project->id) }}" class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white hover:bg-accent-500 hover:scale-110 flex items-center justify-center transition-all duration-200" title="View Detail">
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
                                    <span class="text-xs sm:text-sm text-slate-300 block">
                                        {{ Str::limit($project->description, 50) }}
                                    </span>
                                </div>
                                <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full shrink-0">
                                    {{ $yearBadge }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Mockup-Accurate Default Preset Cards -->
                <!-- Card 1: Thrift Shop App -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1555774698-0b77e0d5fac6?auto=format&fit=crop&w=1000&q=80" 
                         alt="Thrift Shop App" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                        <div class="flex justify-end">
                            <span class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white group-hover:bg-accent-500 group-hover:scale-110 flex items-center justify-center transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                        </div>
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-accent-400 transition-colors">
                                    Thrift Shop App
                                </h3>
                                <span class="text-xs sm:text-sm text-slate-300">UI/UX Design & Mobile App</span>
                            </div>
                            <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full">
                                2023
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Tape Branding -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1589939705384-5185137a7f0f?auto=format&fit=crop&w=1000&q=80" 
                         alt="Tape Branding" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                        <div class="flex justify-end">
                            <span class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white group-hover:bg-accent-500 group-hover:scale-110 flex items-center justify-center transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                        </div>
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-accent-400 transition-colors">
                                    Tape Branding
                                </h3>
                                <span class="text-xs sm:text-sm text-slate-300">Branding & Packaging</span>
                            </div>
                            <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full">
                                2024
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Book Design -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=1000&q=80" 
                         alt="Book Design" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                        <div class="flex justify-end">
                            <span class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white group-hover:bg-accent-500 group-hover:scale-110 flex items-center justify-center transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                        </div>
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-accent-400 transition-colors">
                                    Book Design
                                </h3>
                                <span class="text-xs sm:text-sm text-slate-300">Print & Editorial Layout</span>
                            </div>
                            <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full">
                                2023
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Livora Estate -->
                <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl transition-all duration-300">
                    <img src="https://images.unsplash.com/photo-1531403009284-440f080d1e12?auto=format&fit=crop&w=1000&q=80" 
                         alt="Livora Estate" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/35 to-transparent pointer-events-none"></div>
                    <div class="absolute inset-0 p-6 sm:p-8 flex flex-col justify-between">
                        <div class="flex justify-end">
                            <span class="w-10 h-10 rounded-full bg-white/20 backdrop-blur-md text-white group-hover:bg-accent-500 group-hover:scale-110 flex items-center justify-center transition-all">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
                            </span>
                        </div>
                        <div class="flex items-end justify-between gap-4">
                            <div>
                                <h3 class="text-xl sm:text-2xl font-bold text-white group-hover:text-accent-400 transition-colors">
                                    Livora Estate
                                </h3>
                                <span class="text-xs sm:text-sm text-slate-300">UI/UX Design & Web Platform</span>
                            </div>
                            <span class="text-xs font-semibold text-white/90 bg-white/20 backdrop-blur-md px-3 py-1 rounded-full">
                                2022
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

<!-- Testimonials Section ("Testimonials that highlight my work" with Visitor Form) -->
<section id="testimonials" class="py-24 md:py-32 bg-paper-100 border-t border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16">
            <div class="space-y-2 max-w-xl">
                <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                    TESTIMONIALS
                </span>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                    Testimonials that<br>highlight my work
                </h2>
            </div>
            
            <div class="flex flex-col sm:flex-row sm:items-center gap-4">
                <p class="text-sm text-slate-500 max-w-md leading-relaxed">
                    Real words from founders, product leaders, and design partners who experienced the impact of our collaborative work.
                </p>
                <button id="toggle-t-form-btn" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-accent-300 bg-accent-50 hover:bg-accent-100 text-accent-700 text-xs font-semibold transition-colors shrink-0">
                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tulis Ulasan
                </button>
            </div>
        </div>

        <!-- Interactive Testimonial Card Component (Mockup Layout) -->
        <div class="bg-white rounded-3xl border border-paper-300 p-8 sm:p-12 md:p-16 shadow-[0_10px_30px_rgba(0,0,0,0.03)] relative">
            <!-- Accent Quote Mark Icon -->
            <div class="text-accent-500 text-6xl font-serif font-black leading-none mb-6 select-none">
                &ldquo;
            </div>

            <!-- Testimonial Items (Dynamic from Database or Fallback Mockup) -->
            <div id="testimonial-container">
                @if (isset($testimonials) && $testimonials->count() > 0)
                    @foreach ($testimonials as $tIndex => $testi)
                        <div class="testimonial-slide {{ $tIndex === 0 ? 'active' : 'hidden opacity-0' }} transition-opacity duration-300">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                                <!-- Avatar -->
                                <div class="md:col-span-3 flex justify-center md:justify-start">
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-paper-300 bg-paper-200 flex items-center justify-center shadow-xs">
                                        @if ($testi->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($testi->avatar_path))
                                            <img src="{{ asset('storage/' . $testi->avatar_path) }}" alt="{{ $testi->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-paper-200 text-accent-600 font-extrabold text-3xl flex items-center justify-center">
                                                {{ strtoupper(substr($testi->name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quote & Author -->
                                <div class="md:col-span-9 space-y-4 text-center md:text-left">
                                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 leading-relaxed">
                                        &ldquo;{{ $testi->message }}&rdquo;
                                    </p>
                                    <div>
                                        <span class="block text-base font-extrabold text-slate-950">{{ $testi->name }}</span>
                                        <span class="block text-xs sm:text-sm font-medium text-slate-500">
                                            {{ $testi->role ?? 'Client' }} {{ $testi->company ? 'at ' . $testi->company : '' }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <!-- Slide 1 (Default Mockup) -->
                    <div class="testimonial-slide active transition-opacity duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                            <!-- Client Avatar -->
                            <div class="md:col-span-3 flex justify-center md:justify-start">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-paper-300 shadow-xs">
                                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=400&q=80" 
                                         alt="Daniel Radicchi" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>

                            <!-- Quote & Author -->
                            <div class="md:col-span-9 space-y-4 text-center md:text-left">
                                <p class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 leading-relaxed">
                                    &ldquo;An exceptional designer with a great sense of detail. The final product was not only visually appealing but also highly functional and user-friendly.&rdquo;
                                </p>
                                <div>
                                    <span class="block text-base font-extrabold text-slate-950">Daniel Radicchi</span>
                                    <span class="block text-xs sm:text-sm font-medium text-slate-500">Head of Product at Spead</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div class="testimonial-slide hidden opacity-0 transition-opacity duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                            <div class="md:col-span-3 flex justify-center md:justify-start">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-paper-300 shadow-xs">
                                    <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=400&q=80" 
                                         alt="Sophia Martinez" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="md:col-span-9 space-y-4 text-center md:text-left">
                                <p class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 leading-relaxed">
                                    &ldquo;Collaborating was seamless and incredibly productive. The design system crafted for our platform accelerated our frontend engineering velocity by 40%.&rdquo;
                                </p>
                                <div>
                                    <span class="block text-base font-extrabold text-slate-950">Sophia Martinez</span>
                                    <span class="block text-xs sm:text-sm font-medium text-slate-500">VP of Engineering at Cloudflow</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 3 -->
                    <div class="testimonial-slide hidden opacity-0 transition-opacity duration-300">
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                            <div class="md:col-span-3 flex justify-center md:justify-start">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-paper-300 shadow-xs">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=400&q=80" 
                                         alt="Marcus Chen" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            <div class="md:col-span-9 space-y-4 text-center md:text-left">
                                <p class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 leading-relaxed">
                                    &ldquo;Rarely do you find someone who understands both the visual soul of a brand and the technical constraints of complex applications. A true master of digital product craft.&rdquo;
                                </p>
                                <div>
                                    <span class="block text-base font-extrabold text-slate-950">Marcus Chen</span>
                                    <span class="block text-xs sm:text-sm font-medium text-slate-500">Co-Founder at Hyperion Labs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Slider Control Buttons -->
            <div class="flex items-center justify-center md:justify-end gap-3 pt-8 border-t border-paper-300 mt-8">
                <button id="prev-testimonial" type="button" class="w-10 h-10 rounded-full border border-paper-300 hover:border-slate-800 text-slate-600 hover:text-slate-950 flex items-center justify-center transition-all" aria-label="Previous Testimonial">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-testimonial" type="button" class="w-10 h-10 rounded-full bg-accent-500 hover:bg-accent-600 text-white flex items-center justify-center shadow-md shadow-accent-500/20 transition-all" aria-label="Next Testimonial">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Visitor Testimonial Submission Form (Device-Restricted via Fingerprint & IP) -->
        <div id="visitor-form-container" class="mt-8 hidden transition-all duration-300">
            <div class="paper-card p-6 sm:p-8 bg-white border border-paper-300">
                <div class="max-w-2xl mx-auto space-y-6">
                    <div class="text-center space-y-1">
                        <h3 class="text-xl font-bold text-slate-950">Tinggalkan Ulasan / Testimoni</h3>
                        <p class="text-xs sm:text-sm text-slate-500">
                            Masukan Anda sangat berharga bagi kami. Setiap perangkat dibatasi mengirimkan 1 testimoni.
                        </p>
                    </div>

                    <!-- Already Submitted Notice -->
                    <div id="testimonial-already-submitted" class="hidden p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm text-center">
                        <p class="font-bold">✓ Anda telah mengirimkan ulasan dari perangkat ini.</p>
                        <p class="text-emerald-700 mt-1">Terima kasih banyak atas feedback dan kepercayaan Anda!</p>
                    </div>

                    <!-- Actual Form -->
                    <form id="testimonial-form" class="space-y-4">
                        @csrf
                        <input type="hidden" name="device_fingerprint" id="device_fingerprint">
                        <input type="hidden" name="rating" id="t-rating" value="5">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="t-name" class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap *</label>
                                <input type="text" id="t-name" name="name" required placeholder="Contoh: Daniel Radicchi"
                                       class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-paper-300 focus:outline-none focus:border-accent-500 bg-paper-50/50">
                            </div>
                            <div>
                                <label for="t-role" class="block text-xs font-semibold text-slate-700 mb-1">Jabatan & Perusahaan</label>
                                <input type="text" id="t-role" name="role" placeholder="Contoh: Product Manager di Acme Corp"
                                       class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-paper-300 focus:outline-none focus:border-accent-500 bg-paper-50/50">
                            </div>
                        </div>

                        <!-- Star Rating Selector -->
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 mb-1.5">Rating Kepuasan</label>
                            <div class="flex items-center gap-2">
                                <div class="flex items-center gap-1 text-amber-400 text-xl" id="star-rating-container">
                                    <button type="button" class="star-btn hover:scale-110 transition-transform" data-star="1">★</button>
                                    <button type="button" class="star-btn hover:scale-110 transition-transform" data-star="2">★</button>
                                    <button type="button" class="star-btn hover:scale-110 transition-transform" data-star="3">★</button>
                                    <button type="button" class="star-btn hover:scale-110 transition-transform" data-star="4">★</button>
                                    <button type="button" class="star-btn hover:scale-110 transition-transform" data-star="5">★</button>
                                </div>
                                <span id="rating-text" class="text-xs font-medium text-slate-500">5 dari 5 Bintang</span>
                            </div>
                        </div>

                        <div>
                            <label for="t-message-input" class="block text-xs font-semibold text-slate-700 mb-1">Pesan Ulasan *</label>
                            <textarea id="t-message-input" name="message" rows="3" required placeholder="Tuliskan pengalaman atau penilaian Anda selama bekerja sama..."
                                      class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-paper-300 focus:outline-none focus:border-accent-500 bg-paper-50/50"></textarea>
                        </div>

                        <div id="t-message" class="hidden text-xs font-semibold p-2.5 rounded-xl text-center"></div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            <button type="button" id="cancel-t-form-btn" class="px-5 py-2 rounded-full border border-paper-300 text-slate-600 hover:text-slate-900 text-xs font-semibold">
                                Tutup
                            </button>
                            <button type="submit" id="t-submit-btn" class="px-6 py-2 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-xs font-semibold shadow-sm transition-all">
                                Kirim Ulasan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- Call to Action Banner ("Let's Build Something Truly Meaningful Together" with Warm Paper Texture) -->
<section class="py-20 md:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bg-paper-warm rounded-3xl border border-paper-300 shadow-[0_15px_40px_rgba(45,35,25,0.06)] overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-8 sm:p-12 md:p-16">
                
                <!-- Left Banner Copy -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left z-10">
                    <h2 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        Let's Build Something Truly<br>
                        <span class="italic font-bold text-accent-500">Meaningful Together</span>
                    </h2>
                    
                    <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Whether you are launching a brand-new venture, elevating an existing digital ecosystem, or seeking expert product consulting, I am excited to connect.
                    </p>

                    <div class="pt-2">
                        <a href="mailto:{{ $user->email_contact ?? ($user->email ?? 'hi@getincontact.com') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-sm sm:text-base shadow-lg shadow-accent-500/30 hover:shadow-xl hover:shadow-accent-500/40 hover:-translate-y-0.5 transition-all">
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
                        @if ($user->cta_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->cta_image_path))
                            <img src="{{ asset('storage/' . $user->cta_image_path) }}" 
                                 alt="Let's build together" 
                                 class="w-full h-full object-cover object-top drop-shadow-xl">
                        @else
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=80" 
                                 alt="Let's build together" 
                                 class="w-full h-full object-cover object-top drop-shadow-xl">
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- Vanilla JS for Interactive Elements (Tabs, Testimonial Slider & Device-Restricted Form) -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    // 1. EXPERIENCE & EDUCATION TABS
    const tabBtnExp = document.getElementById('tab-btn-exp');
    const tabBtnEdu = document.getElementById('tab-btn-edu');
    const tabContentExp = document.getElementById('tab-content-exp');
    const tabContentEdu = document.getElementById('tab-content-edu');

    if (tabBtnExp && tabBtnEdu && tabContentExp && tabContentEdu) {
        tabBtnExp.addEventListener('click', () => {
            tabBtnExp.className = 'px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-xs transition-all';
            tabBtnEdu.className = 'px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all';
            tabContentEdu.classList.add('hidden', 'opacity-0');
            tabContentExp.classList.remove('hidden');
            setTimeout(() => tabContentExp.classList.remove('opacity-0'), 20);
        });

        tabBtnEdu.addEventListener('click', () => {
            tabBtnEdu.className = 'px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-xs transition-all';
            tabBtnExp.className = 'px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-slate-600 hover:text-accent-500 transition-all';
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

    // 3. VISITOR TESTIMONIAL FORM (DEVICE RESTRICTION VIA FINGERPRINT + LOCALSTORAGE)
    const toggleFormBtn = document.getElementById('toggle-t-form-btn');
    const formContainer = document.getElementById('visitor-form-container');
    const cancelFormBtn = document.getElementById('cancel-t-form-btn');
    const tForm = document.getElementById('testimonial-form');
    const tAlready = document.getElementById('testimonial-already-submitted');
    const tFingerprintInput = document.getElementById('device_fingerprint');
    const tMessage = document.getElementById('t-message');
    const tSubmitBtn = document.getElementById('t-submit-btn');

    // Generate or fetch unique device identifier
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

    // Toggle Form visibility
    if (toggleFormBtn && formContainer) {
        toggleFormBtn.addEventListener('click', () => {
            formContainer.classList.toggle('hidden');
            if (!formContainer.classList.contains('hidden')) {
                formContainer.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        });
    }
    if (cancelFormBtn && formContainer) {
        cancelFormBtn.addEventListener('click', () => {
            formContainer.classList.add('hidden');
        });
    }

    // Interactive Star Rating
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

    // Handle AJAX Form Submission
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

                    alert('Terima kasih! Ulasan Anda berhasil dikirimkan.');
                    location.reload();
                } else {
                    tMessage.classList.remove('hidden');
                    tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                    tMessage.innerText = data.message || 'Terjadi kesalahan dalam mengirimkan testimoni.';
                    tSubmitBtn.disabled = false;
                    tSubmitBtn.innerText = 'Kirim Ulasan';
                }
            } catch (err) {
                tMessage.classList.remove('hidden');
                tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                tMessage.innerText = 'Gagal terhubung ke server. Silakan coba lagi.';
                tSubmitBtn.disabled = false;
                tSubmitBtn.innerText = 'Kirim Ulasan';
            }
        });
    }
});
</script>
@endsection
