@extends('layouts.public')

@section('content')
<!-- Hero Section (Organic Paper Texture, 3-Column Mockup Composition & Ambient Warmth) -->
<section id="hero" class="relative pt-32 pb-20 md:pt-40 md:pb-28 overflow-hidden w-full max-w-full">
    <!-- Soft Reddish-Orange Ambient Glow (Morph Bloom on load + breathing pulse) -->
    <div class="absolute top-10 left-1/2 -translate-x-1/2 w-[700px] max-w-full h-[350px] bg-accent-400/15 blur-[120px] rounded-full pointer-events-none -z-0 animate-aura-bloom"></div>

    <!-- Giant Faint Background Watermark: Title from Mockup -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0 flex items-center justify-center">
        <div class="select-none text-[5rem] sm:text-[9rem] md:text-[13rem] lg:text-[16rem] font-black text-slate-900/[0.03] uppercase tracking-tighter whitespace-nowrap">
            {{ strtoupper($user->title ?? 'BRAND DESIGNER') }}
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-6 items-center">
            
            <!-- Left Column: Typographic Hero & Intro (Dramatic Morph-In Entrance) -->
            <div class="lg:col-span-4 space-y-5 text-center lg:text-left min-w-0 animate-morph-left">
                <div class="space-y-1">
                    <span class="block text-2xl sm:text-3xl font-extrabold uppercase tracking-tight text-slate-800">
                        I'M
                    </span>
                    <h1 class="text-5xl sm:text-7xl md:text-8xl font-black italic tracking-tighter text-slate-950 leading-none break-words">
                        {{ explode(' ', $user->name ?? 'Ethan')[0] }}
                    </h1>
                </div>

                <!-- Stylized Title Pill with Spring Morph -->
                <div>
                    <span class="inline-flex items-center px-4 py-1.5 rounded-full text-[11px] sm:text-xs font-bold uppercase tracking-wider bg-accent-500 text-white shadow-sm shadow-accent-500/30 transition-transform duration-300 hover:scale-105 cursor-default animate-morph-pill">
                        {{ $user->title ?? 'DIGITAL PRODUCT DESIGNER' }}
                    </span>
                </div>

                <!-- Bio / Intro Copy -->
                <p class="text-sm sm:text-base font-normal text-slate-600 leading-relaxed max-w-md mx-auto lg:mx-0">
                    {{ $user->bio ?? 'Creating meaningful digital products that drive engagement, solve complex business problems, and elevate human experiences.' }}
                </p>

                <!-- Quick Action Buttons (Staggered Morph Pop) -->
                <div class="pt-2 flex flex-wrap items-center justify-center lg:justify-start gap-3">
                    <a href="#projects" class="animate-morph-tool delay-300 inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-slate-900 hover:bg-accent-500 text-white text-xs sm:text-sm font-semibold transition-all duration-200 shadow-sm hover:shadow-md hover:shadow-accent-500/25 hover:-translate-y-0.5 active:translate-y-0">
                        Explore Work
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                    <a href="#about" class="animate-morph-tool delay-350 inline-flex items-center px-5 py-2.5 rounded-full border border-paper-300 hover:border-slate-800 bg-white/70 hover:bg-white text-xs sm:text-sm font-semibold text-slate-800 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-200">
                        About Me
                    </a>
                </div>
            </div>

            <!-- Middle Column: Portrait Cutout Photo with Morph-In Glassmorphism Tools Card -->
            <div class="lg:col-span-4 flex flex-col items-center justify-center order-first lg:order-none">
                <!-- Portrait Cutout Container with Organic Morph-In -->
                <div class="animate-morph-portrait relative w-64 h-80 sm:w-80 sm:h-96 md:w-96 md:h-[430px] flex items-end justify-center">
                    <!-- Subtle ambient warmth behind portrait -->
                    <div class="absolute inset-0 bg-gradient-to-t from-accent-500/15 to-transparent rounded-full blur-2xl -z-10 animate-aura-pulse"></div>

                    @if ($user->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->avatar_path))
                        <img src="{{ asset('storage/' . $user->avatar_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover object-top rounded-3xl drop-shadow-2xl transition-transform duration-700 hover:scale-[1.02]">
                    @else
                        <!-- High Fidelity Designer Portrait Matching Mockup -->
                        <div class="relative w-full h-full overflow-hidden rounded-3xl group">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&w=900&q=80" 
                                 alt="{{ $user->name ?? 'Ethan Ward' }}" 
                                 class="w-full h-full object-cover object-top drop-shadow-2xl filter contrast-[1.02] brightness-[1.02] transition-transform duration-700 group-hover:scale-105">
                            <!-- Soft subtle bottom gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-white/20 via-transparent to-transparent"></div>
                        </div>
                    @endif
                </div>

                <!-- Glassmorphism Tools Card Floating on Lower Photo -->
                <!-- Outer wrapper handles the continuous floating levitation -->
                <div class="relative -mt-10 sm:-mt-14 w-full max-w-[340px] sm:max-w-[420px] z-20 px-2 sm:px-0 animate-float-levitate">
                    <!-- Inner card runs the dramatic Morph-In entrance + Specular Shimmer Wipe -->
                    <div class="animate-morph-glass morph-shimmer bg-white/80 backdrop-blur-xl border border-white/90 shadow-[0_16px_36px_rgba(15,23,42,0.12)] rounded-2xl sm:rounded-3xl p-3 sm:p-4 transition-all duration-300 hover:shadow-[0_24px_48px_rgba(255,77,45,0.18)] hover:border-white">
                        <!-- Top Header Indicator -->
                        <div class="flex items-center justify-between pb-2 mb-2 border-b border-slate-200/60">
                            <div class="flex items-center gap-1.5">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-emerald-500"></span>
                                </span>
                                <span class="text-[10px] sm:text-[11px] font-extrabold uppercase tracking-wider text-slate-800">
                                    Tools &amp; Stack
                                </span>
                            </div>
                            <span class="text-[9px] sm:text-[10px] font-bold px-2 py-0.5 rounded-full bg-accent-50 text-accent-600 border border-accent-200 transition-colors hover:bg-accent-100">
                                10 Core Tools
                            </span>
                        </div>

                        <!-- 10 Tools Grid (Cascading Morph Pop for each tool) -->
                        <div class="grid grid-cols-5 gap-1 sm:gap-1.5 text-center">
                            <!-- 1. Figma -->
                            <div class="animate-morph-tool delay-100 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 38 57" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19 28.5C19 23.2533 23.2533 19 28.5 19C33.7467 19 38 23.2533 38 28.5C38 33.7467 33.7467 38 28.5 38C23.2533 38 19 33.7467 19 28.5Z" fill="#1ABCFE"/>
                                        <path d="M0 47.5C0 42.2533 4.25329 38 9.5 38H19V47.5C19 52.7467 14.7467 57 9.5 57C4.25329 57 0 52.7467 0 47.5Z" fill="#0ACF83"/>
                                        <path d="M19 0V19H28.5C33.7467 19 38 14.7467 38 9.5C38 4.25329 33.7467 0 28.5 0H19Z" fill="#FF7262"/>
                                        <path d="M0 9.5C0 14.7467 4.25329 19 9.5 19H19V0H9.5C4.25329 0 0 4.25329 0 9.5Z" fill="#F24E1E"/>
                                        <path d="M0 28.5C0 33.7467 4.25329 38 9.5 38H19V19H9.5C4.25329 19 0 23.2533 0 28.5Z" fill="#A259FF"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Figma
                                </span>
                            </div>

                            <!-- 2. Capcut -->
                            <div class="animate-morph-tool delay-150 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="32" rx="7" fill="#0F172A"/>
                                        <path d="M7 11.5C7 11.5 10.5 14 16 14C21.5 14 25 11.5 25 11.5L23.5 16C23.5 16 20 14 16 14C12 14 8.5 16 8.5 16L7 11.5Z" fill="#FFFFFF"/>
                                        <path d="M7 20.5C7 20.5 10.5 18 16 18C21.5 18 25 20.5 25 20.5L23.5 16C23.5 16 20 18 16 18C12 18 8.5 16 8.5 16L7 20.5Z" fill="#00D2C4"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Capcut
                                </span>
                            </div>

                            <!-- 3. Laravel -->
                            <div class="animate-morph-tool delay-200 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M37.3 12.3L21.4 3.1c-.8-.5-1.9-.5-2.8 0L2.7 12.3c-.9.5-1.4 1.4-1.4 2.4v18.4c0 1 .5 1.9 1.4 2.4l15.9 9.2c.8.5 1.9.5 2.8 0l15.9-9.2c.9-.5 1.4-1.4 1.4-2.4V14.7c0-1-.5-1.9-1.4-2.4z" fill="#FF2D20"/>
                                        <path d="M20 22.8l15-8.7-15-8.7-15 8.7 15 8.7z" fill="#FF5E54"/>
                                        <path d="M5 16.3v13.5l15 8.7V25L5 16.3z" fill="#E0241A"/>
                                        <path d="M35 16.3L20 25v13.5l15-8.7V16.3z" fill="#B31911"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Laravel
                                </span>
                            </div>

                            <!-- 4. Rust -->
                            <div class="animate-morph-tool delay-250 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="16" cy="16" r="14" fill="#1E1E1E"/>
                                        <circle cx="16" cy="16" r="11.5" fill="none" stroke="#DEA584" stroke-width="1.8"/>
                                        <path d="M12 10h5.5c2.3 0 4 1.3 4 3.5 0 1.8-1.3 3-3.2 3.4L22 22h-3l-3.3-4.8H14.5V22H12V10zm2.5 5h2.8c1.1 0 1.9-.6 1.9-1.5s-.8-1.5-1.9-1.5h-2.8V15z" fill="#FFFFFF"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Rust
                                </span>
                            </div>

                            <!-- 5. PHP -->
                            <div class="animate-morph-tool delay-300 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <ellipse cx="16" cy="16" rx="15" ry="9.5" fill="#777BB4"/>
                                        <path d="M9.5 12.5h2.3c1.5 0 2.3.7 2 2-.3 1.3-1.6 2-3 2h-1.3l-.7 3H7.3l2.2-7zm1 2.7h.8c.8 0 1.4-.3 1.5-.9.1-.5-.3-.8-1.1-.8h-.8l-.4 1.7zm6-2.7h1.5l-.7 3h2.2l.7-3h1.5l-1.6 7h-1.5l.7-2.8h-2.2l-.7 2.8h-1.5l1.6-7zm7.5 0h2.3c1.5 0 2.3.7 2 2-.3 1.3-1.6 2-3 2h-1.3l-.7 3h-1.5l2.2-7zm1 2.7h.8c.8 0 1.4-.3 1.5-.9.1-.5-.3-.8-1.1-.8h-.8l-.4 1.7z" fill="#FFFFFF"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    PHP
                                </span>
                            </div>

                            <!-- 6. Tailwind -->
                            <div class="animate-morph-tool delay-350 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 9c-4 0-6.5 2-7.5 6 1.5-2 3.5-2.7 6-2 1.4.4 2.4 1.4 3.5 2.6C19.8 17.4 22 20 27 20c4 0 6.5-2 7.5-6-1.5 2-3.5 2.7-6 2-1.4-.4-2.4-1.4-3.5-2.6C23.2 11.6 21 9 16 9zm-11 9c-4 0-6.5 2-7.5 6 1.5-2 3.5-2.7 6-2 1.4.4 2.4 1.4 3.5 2.6C8.8 26.4 11 29 16 29c4 0 6.5-2 7.5-6-1.5 2-3.5 2.7-6 2-1.4-.4-2.4-1.4-3.5-2.6C12.2 20.6 10 18 5 18z" transform="scale(0.85) translate(2, 0)" fill="#06B6D4"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Tailwind
                                </span>
                            </div>

                            <!-- 7. Supabase -->
                            <div class="animate-morph-tool delay-400 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="32" rx="7" fill="#1C1C1C"/>
                                        <path d="M18.8 3L6.5 18.2c-.6.8 0 1.9 1 1.9H16l-2.8 9.9c-.4 1.2 1.1 2 2 1.1L27.5 15.9c.6-.8 0-1.9-1-1.9H18l2.8-9.9c.4-1.2-1.1-2-2-1.1z" fill="#3ECF8E"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    Supabase
                                </span>
                            </div>

                            <!-- 8. MY SQL -->
                            <div class="animate-morph-tool delay-450 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="32" rx="7" fill="#00758F"/>
                                        <path d="M7 16c2-4 6-7 10-6 3 .8 5.5 3 7 6-1.5 2-4 4.5-8 4-3-.4-6-2.5-9-4z" fill="#F29111"/>
                                        <circle cx="19" cy="13" r="1.5" fill="#FFFFFF"/>
                                        <path d="M12 21c2 2 6 3 9 1" stroke="#FFFFFF" stroke-width="1.5" stroke-linecap="round"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    MY SQL
                                </span>
                            </div>

                            <!-- 9. MEDIAMTX -->
                            <div class="animate-morph-tool delay-500 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="32" rx="7" fill="#4F46E5"/>
                                        <path d="M8 11a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 01-2 2h-8a2 2 0 01-2-2V11z" fill="#FFFFFF"/>
                                        <path d="M20 14l5-3v10l-5-3v-4z" fill="#A5B4FC"/>
                                        <circle cx="14" cy="16" r="2" fill="#4F46E5"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    MEDIAMTX
                                </span>
                            </div>

                            <!-- 10. WEB RTC -->
                            <div class="animate-morph-tool delay-600 flex flex-col items-center justify-center p-1 sm:p-1.5 rounded-xl hover:bg-white/90 hover:scale-105 transition-all duration-150 group/tool cursor-default">
                                <div class="w-6 h-6 sm:w-7 sm:h-7 flex items-center justify-center">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="32" height="32" rx="7" fill="#0284C7"/>
                                        <circle cx="16" cy="9.5" r="2.8" fill="#FFFFFF"/>
                                        <circle cx="9.5" cy="22" r="2.8" fill="#FFFFFF"/>
                                        <circle cx="22.5" cy="22" r="2.8" fill="#FFFFFF"/>
                                        <path d="M16 9.5L9.5 22M16 9.5L22.5 22M9.5 22H22.5" stroke="#BAE6FD" stroke-width="1.8"/>
                                        <circle cx="16" cy="17" r="1.3" fill="#38BDF8"/>
                                    </svg>
                                </div>
                                <span class="text-[9px] sm:text-[10px] font-bold text-slate-700 group-hover/tool:text-accent-500 tracking-tight mt-1 truncate max-w-full">
                                    WEB RTC
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Follow Me Socials & Big Display Label (Dramatic Morph-In Entrance) -->
            <div class="lg:col-span-4 flex flex-col justify-between h-full space-y-12 lg:space-y-24 text-center lg:text-left animate-morph-right">
                <!-- Top: Follow Me Socials -->
                <div class="space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-500 block animate-morph-pill">
                        Follow me
                    </span>
                    <div class="flex items-center justify-center lg:justify-start gap-2.5">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks->take(4) as $sIndex => $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" class="animate-morph-social delay-{{ ($sIndex + 1) * 75 }} w-9 h-9 rounded-full bg-white border border-paper-300 text-slate-700 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center shadow-xs hover:scale-110 hover:-translate-y-0.5 transition-all duration-200" title="{{ $social->name }}">
                                    @include('partials.social-icon', ['social' => $social])
                                </a>
                            @endforeach
                        @else
                            <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="animate-morph-social delay-100 w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center hover:scale-110 hover:-translate-y-0.5 transition-all duration-200" title="LinkedIn">
                                @include('partials.social-icon', ['type' => 'linkedin'])
                            </a>
                            <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="animate-morph-social delay-150 w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center hover:scale-110 hover:-translate-y-0.5 transition-all duration-200" title="GitHub">
                                @include('partials.social-icon', ['type' => 'github'])
                            </a>
                            <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="animate-morph-social delay-200 w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center hover:scale-110 hover:-translate-y-0.5 transition-all duration-200" title="Instagram">
                                @include('partials.social-icon', ['type' => 'instagram'])
                            </a>
                            <a href="mailto:{{ $user->email_contact ?: ($user->email ?: 'thoriqpasya860@gmail.com') }}" class="animate-morph-social delay-250 w-9 h-9 rounded-full bg-white border border-paper-300 shadow-xs text-slate-600 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center hover:scale-110 hover:-translate-y-0.5 transition-all duration-200" title="Email: thoriqpasya860@gmail.com">
                                @include('partials.social-icon', ['type' => 'email'])
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
                        @foreach ($titleWords as $wIndex => $word)
                            <span class="block animate-morph-right delay-{{ ($wIndex + 1) * 100 }}">{{ $word }}</span>
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
            <div class="lg:col-span-6 reveal-left">
                <div class="relative overflow-hidden rounded-3xl shadow-[0_15px_35px_rgba(0,0,0,0.06)] border border-paper-300 aspect-[4/3] group bg-paper-100 hover:shadow-xl transition-all duration-500">
                    @if ($user->about_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->about_image_path))
                        <img src="{{ asset('storage/' . $user->about_image_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @else
                        <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=1200&q=80" 
                             alt="Designing with Purpose" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                    @endif
                </div>
            </div>

            <!-- Right: About Editorial & CTA -->
            <div class="lg:col-span-6 space-y-6 reveal-right delay-150">
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
                                <span class="px-3 py-1 rounded-full text-xs font-semibold uppercase tracking-wider border shadow-2xs hover:scale-105 transition-transform cursor-default"
                                      style="background-color: {{ $badge->bg_color }}; color: {{ $badge->text_color }}; border-color: rgba(0,0,0,0.06);">
                                    {{ $badge->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="pt-2">
                    <a href="#services" class="inline-flex items-center justify-center px-6 py-2.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-sm font-semibold shadow-md shadow-accent-500/25 hover:shadow-lg hover:shadow-accent-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all">
                        Read More
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Stats / Metrics Strip (4 Horizontal Metrics with Animated Digital Counter Ticker) -->
@php
    $yearsNum = (int) preg_replace('/[^0-9]/', '', $user->years_experience ?? '10');
    $projectsRaw = $user->projects_completed ?? (max(109, ($user->projects->count() > 0 ? $user->projects->count() * 12 : 109)) . '+');
    $projectsNum = (int) preg_replace('/[^0-9]/', '', $projectsRaw);
    $satisfactionNum = (int) preg_replace('/[^0-9]/', '', $user->client_satisfaction ?? '96');
@endphp
<section class="py-12 md:py-16 bg-white border-b border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-6 text-center divide-y md:divide-y-0 md:divide-x divide-paper-300 reveal-on-scroll">
            <!-- Stat 1: Years Experience -->
            <div class="pt-4 md:pt-0 group">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block group-hover:text-accent-500 transition-colors"
                      data-counter-target="{{ $yearsNum > 0 ? $yearsNum : 10 }}" 
                      data-counter-suffix="+">
                    {{ $user->years_experience ?? '10+' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Years Experience
                </span>
            </div>

            <!-- Stat 2: Projects Completed -->
            <div class="pt-4 md:pt-0 group">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block group-hover:text-accent-500 transition-colors"
                      data-counter-target="{{ $projectsNum > 0 ? $projectsNum : 109 }}" 
                      data-counter-suffix="+">
                    {{ $projectsRaw }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Project Completed
                </span>
            </div>

            <!-- Stat 3: Support Available -->
            <div class="pt-4 md:pt-0 group">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block group-hover:text-accent-500 transition-colors"
                      data-counter-target="20" 
                      data-counter-suffix="/7">
                    {{ $user->support_available ?? '20/7' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Support Available
                </span>
            </div>

            <!-- Stat 4: Client Satisfaction -->
            <div class="pt-4 md:pt-0 group">
                <span class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-950 tracking-tight block group-hover:text-accent-500 transition-colors"
                      data-counter-target="{{ $satisfactionNum > 0 ? $satisfactionNum : 96 }}" 
                      data-counter-suffix="%">
                    {{ $user->client_satisfaction ?? '96%' }}
                </span>
                <span class="text-xs sm:text-sm font-medium text-slate-500 mt-1 block uppercase tracking-wider">
                    Client Satisfaction
                </span>
            </div>
        </div>
    </div>
</section>

<!-- Services / Bento Grid Section (Exact 6-Item Mockup Layout with Staggered Scroll Animations) -->
<section id="services" class="py-24 md:py-32 bg-paper-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal-on-scroll">
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
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white reveal-on-scroll delay-75">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 group-hover:translate-x-1 transition-all duration-300 block mb-6">
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
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white reveal-on-scroll delay-150">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 group-hover:translate-x-1 transition-all duration-300 block mb-6">
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
            <div class="overflow-hidden rounded-3xl border border-paper-300 shadow-sm aspect-[4/3] md:aspect-auto group bg-white reveal-on-scroll delay-200 hover:shadow-xl transition-all duration-500">
                @if ($user->bento_image_1 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_1))
                    <img src="{{ asset('storage/' . $user->bento_image_1) }}" 
                         alt="Mobile App Mockup" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @else
                    <img src="https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?auto=format&fit=crop&w=800&q=80" 
                         alt="Mobile App Mockup" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @endif
            </div>

            <!-- Bento Visual Showcase 2: Streetwear / Brand Print Graphic -->
            <div class="overflow-hidden rounded-3xl border border-paper-300 shadow-sm aspect-[4/3] md:aspect-auto group bg-white reveal-on-scroll delay-250 hover:shadow-xl transition-all duration-500">
                @if ($user->bento_image_2 && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->bento_image_2))
                    <img src="{{ asset('storage/' . $user->bento_image_2) }}" 
                         alt="Brand Graphic Hoodie" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @else
                    <img src="https://images.unsplash.com/photo-1556905055-8f358a7a47b2?auto=format&fit=crop&w=800&q=80" 
                         alt="Brand Graphic Hoodie" 
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                @endif
            </div>

            <!-- Card 03: Graphic Design -->
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white reveal-on-scroll delay-300">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 group-hover:translate-x-1 transition-all duration-300 block mb-6">
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
            <div class="modern-card p-8 flex flex-col justify-between h-full group bg-white reveal-on-scroll delay-400">
                <div>
                    <span class="text-3xl font-black text-slate-300 group-hover:text-accent-400 group-hover:translate-x-1 transition-all duration-300 block mb-6">
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
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal-on-scroll">
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
                    <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/80 hover:shadow-xs transition-all duration-300 group reveal-on-scroll">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                            <!-- Period / Year -->
                            <div class="w-full sm:w-44 lg:w-48 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                    {{ $exp->start_date ? $exp->start_date->format('Y') : '2023' }} &mdash; 
                                    {{ $exp->end_date ? $exp->end_date->format('Y') : 'Present' }}
                                </span>
                            </div>

                            <!-- Role / Title, Mobile Company & Description -->
                            <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                                <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                    {{ $exp->position }}
                                </h3>
                                <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                    {{ $exp->company_name }}
                                </span>
                                @if ($exp->has_bullet_points)
                                    <ul class="mt-2.5 space-y-1.5 text-xs sm:text-sm text-slate-600 max-w-2xl">
                                        @foreach ($exp->points as $point)
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-accent-500 mt-1.5 shrink-0"></span>
                                                <span class="leading-relaxed">{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif ($exp->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-2 max-w-2xl leading-relaxed whitespace-pre-line">
                                        {{ $exp->description }}
                                    </p>
                                @endif
                            </div>

                            <!-- Company / Studio (Desktop Only, Right Justified) -->
                            <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                                <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                    {{ $exp->company_name }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <!-- Mockup-Accurate Fallback Preset Rows -->
                <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                        <div class="w-full sm:w-44 lg:w-48 shrink-0">
                            <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                2023 &mdash; Present
                            </span>
                        </div>
                        <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                            <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                Senior UI/UX Designer
                            </h3>
                            <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                Odama Studio
                            </span>
                        </div>
                        <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                            <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                Odama Studio
                            </span>
                        </div>
                    </div>
                </div>

                <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                        <div class="w-full sm:w-44 lg:w-48 shrink-0">
                            <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                2022 &mdash; 2023
                            </span>
                        </div>
                        <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                            <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                Product Designer
                            </h3>
                            <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                Voltrans Studio
                            </span>
                            <p class="text-xs sm:text-sm text-slate-600 mt-1 max-w-2xl leading-relaxed">
                                Led user research and iterative prototyping for cross-platform applications and design system maintenance.
                            </p>
                        </div>
                        <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                            <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                Voltrans Studio
                            </span>
                        </div>
                    </div>
                </div>

                <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                        <div class="w-full sm:w-44 lg:w-48 shrink-0">
                            <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                2021 &mdash; 2022
                            </span>
                        </div>
                        <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                            <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                Graphic Designer
                            </h3>
                            <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                Kanota Studio
                            </span>
                        </div>
                        <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                            <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                Kanota Studio
                            </span>
                        </div>
                    </div>
                </div>

                <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                        <div class="w-full sm:w-44 lg:w-48 shrink-0">
                            <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                2020 &mdash; 2021
                            </span>
                        </div>
                        <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                            <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                Web Developer
                            </h3>
                            <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                Peluru Studio
                            </span>
                        </div>
                        <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                            <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                Peluru Studio
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Education List Container (Hidden by default, activated via tab) -->
        <div id="tab-content-edu" class="divide-y divide-paper-300 border-y border-paper-300 hidden opacity-0 transition-opacity duration-300">
            @if ($user->educations && $user->educations->count() > 0)
                @foreach ($user->educations as $edu)
                    <div class="py-5 sm:py-8 px-3 sm:px-4 rounded-2xl hover:bg-white/70 transition-all duration-200 group">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1.5 sm:gap-6">
                            <!-- Period / Year -->
                            <div class="w-full sm:w-44 lg:w-48 shrink-0">
                                <span class="text-xs sm:text-sm font-semibold text-slate-500 uppercase tracking-wider block">
                                    {{ $edu->start_year }} &mdash; {{ $edu->end_year ?? 'Selesai' }}
                                </span>
                            </div>

                            <!-- Degree / Major, Mobile Institution & Description -->
                            <div class="flex-1 min-w-0 sm:pr-6 space-y-1">
                                <h3 class="text-base sm:text-xl font-bold text-slate-900 group-hover:text-accent-500 transition-colors leading-snug">
                                    {{ $edu->degree }}{{ !empty($edu->major) ? ' &bull; ' . $edu->major : '' }}
                                </h3>
                                <span class="block sm:hidden text-xs font-semibold text-accent-600">
                                    {{ $edu->institution_name }}
                                </span>
                                @if ($edu->has_bullet_points)
                                    <ul class="mt-2.5 space-y-1.5 text-xs sm:text-sm text-slate-600 max-w-2xl">
                                        @foreach ($edu->points as $point)
                                            <li class="flex items-start gap-2.5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-accent-500 mt-1.5 shrink-0"></span>
                                                <span class="leading-relaxed">{{ $point }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @elseif ($edu->description)
                                    <p class="text-xs sm:text-sm text-slate-600 mt-2 max-w-2xl leading-relaxed whitespace-pre-line">
                                        {{ $edu->description }}
                                    </p>
                                @endif
                            </div>

                            <!-- Institution (Desktop Only, Right Justified) -->
                            <div class="hidden sm:flex sm:w-64 md:w-72 lg:w-80 shrink-0 sm:justify-end text-right">
                                <span class="text-sm sm:text-base font-bold text-slate-800 text-right leading-snug">
                                    {{ $edu->institution_name }}
                                </span>
                            </div>
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
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal-on-scroll">
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
                        $delays = ['delay-100', 'delay-200', 'delay-150', 'delay-250'];
                        $delayClass = $delays[$index % 4];
                    @endphp

                    <div class="group relative rounded-3xl overflow-hidden aspect-[4/3] bg-slate-900 border border-paper-300 shadow-md hover:shadow-2xl hover:-translate-y-1.5 transition-all duration-500 reveal-on-scroll {{ $delayClass }}">
                        <!-- Project Image with Zoom on Hover -->
                        <img src="{{ $imgSrc }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-full object-cover group-hover:scale-108 transition-transform duration-700">

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

<!-- ======================================================== -->
<!-- GITHUB CONTRIBUTOR & CODE ACTIVITY SECTION (DYNAMIC)     -->
<!-- ======================================================== -->
@php
    $ghUsername = $user->github_username ?? 'ThoriqMP';
@endphp
<section id="activity" class="py-24 md:py-32 bg-[#090D16] text-white relative overflow-hidden border-t border-slate-800">
    <!-- Ambient Reddish Glow (Breathing Pulse) -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[450px] bg-accent-500/10 blur-[140px] rounded-full pointer-events-none z-0 animate-aura-pulse"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full space-y-12">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 border-b border-slate-800/80 pb-8 reveal-on-scroll">
            <div class="space-y-2 max-w-xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-accent-500/10 border border-accent-500/30 text-accent-400 text-xs font-bold uppercase tracking-wider">
                    <span class="w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
                    Live GitHub Matrix
                </div>
                <h2 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight leading-tight text-white">
                    Code Activity &amp;<br>Open-Source Impact
                </h2>
            </div>
            
            <p class="text-sm text-slate-400 max-w-md leading-relaxed">
                Aktivitas pemrograman nyata yang terhubung langsung dengan repositori GitHub saya secara dinamis dan real-time.
            </p>
        </div>

        <!-- Main GitHub Console Card (Matching Screenshot Dark Aesthetic with Reveal Scale Animation) -->
        <div class="bg-[#0D1117] border border-[#30363D] rounded-3xl p-5 sm:p-7 md:p-9 shadow-[0_20px_50px_rgba(0,0,0,0.5)] space-y-8 reveal-scale">
            
            <!-- Top Profile Strip -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-6 border-b border-[#21262D]">
                <div class="flex items-center gap-4">
                    <div class="relative shrink-0 group">
                        <img id="gh-avatar" 
                             src="https://github.com/{{ $ghUsername }}.png" 
                             alt="{{ $ghUsername }}" 
                             class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 border-[#30363D] group-hover:border-accent-500 bg-slate-800 object-cover shadow-md transition-all duration-300 group-hover:scale-105">
                        <span class="absolute bottom-0 right-0 w-4 h-4 rounded-full bg-emerald-500 border-2 border-[#0D1117]" title="Active Status"></span>
                    </div>
                    <div>
                        <div class="flex items-center gap-2">
                            <h3 class="text-lg sm:text-xl font-extrabold text-white tracking-tight">
                                {{ $user->name }}
                            </h3>
                            <span class="text-xs font-medium text-slate-400">
                                ({{ '@' . $ghUsername }})
                            </span>
                        </div>
                        <div class="flex items-center gap-3 text-xs text-slate-400 mt-1 flex-wrap">
                            <span class="flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M2 5.5a3.5 3.5 0 1 1 5.898 2.549 5.508 5.508 0 0 1 3.034 4.084.75.75 0 1 1-1.482.235 4.002 4.002 0 0 0-7.898 0 .75.75 0 0 1-1.482-.236A5.507 5.507 0 0 1 3.102 8.05 3.493 3.493 0 0 1 2 5.5ZM11 4a3.001 3.001 0 0 1 2.22 5.018 5.01 5.01 0 0 1 2.56 3.012.749.749 0 0 1-.885.953.754.754 0 0 1-.58-.58 3.51 3.51 0 0 0-3.315-2.653.75.75 0 0 1 0-1.5 1.5 1.5 0 0 0 0-3 .75.75 0 0 1 0-1.5ZM5.5 3.5a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z"/>
                                </svg>
                                <strong id="gh-followers" class="text-slate-200">5</strong> followers
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1">
                                <strong id="gh-following" class="text-slate-200">6</strong> following
                            </span>
                            <span>&bull;</span>
                            <span class="flex items-center gap-1">
                                <strong id="gh-public-repos" class="text-slate-200">22+</strong> repositories
                            </span>
                        </div>
                    </div>
                </div>

                <a href="https://github.com/{{ $ghUsername }}" 
                   target="_blank" 
                   rel="noopener noreferrer" 
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-[#21262D] hover:bg-accent-500 hover:text-white text-slate-200 text-xs font-bold border border-[#30363D] hover:border-accent-400 hover:-translate-y-0.5 active:translate-y-0 transition-all shadow-sm shrink-0 group">
                    <svg class="w-4 h-4 fill-current transition-transform group-hover:rotate-12" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.53 1.032 1.53 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"/>
                    </svg>
                    Buka Profil GitHub
                    <svg class="w-3.5 h-3.5 transition-transform group-hover:translate-x-0.5 group-hover:-translate-y-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                    </svg>
                </a>
            </div>

            <!-- Heatmap Contribution Calendar Box -->
            <div class="space-y-4 reveal-on-scroll delay-100">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                    <div class="flex items-center gap-2">
                        <span id="gh-total-commits" 
                              class="text-base sm:text-lg font-bold text-white tracking-tight"
                              data-counter-target="1812" 
                              data-counter-comma="true" 
                              data-counter-suffix=" kontribusi">
                            1,812 kontribusi
                        </span>
                        <span class="text-xs text-slate-400 font-normal">
                            sepanjang tahun 2026
                        </span>
                    </div>

                    <!-- Legend -->
                    <div class="flex items-center gap-1.5 text-[11px] text-slate-400">
                        <span>Kurang</span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-[#161B22]"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-[#632C03]"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-[#934005]"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-[#C25408]"></span>
                        <span class="w-2.5 h-2.5 rounded-xs bg-[#FF4D2D]"></span>
                        <span>Lebih Sering</span>
                    </div>
                </div>

                <!-- Live Dynamic Heatmap SVG Container -->
                <div class="w-full bg-[#161B22] border border-[#30363D] hover:border-slate-600 rounded-2xl p-4 sm:p-5 overflow-x-auto scrollbar-thin scrollbar-thumb-slate-700 transition-colors">
                    <div class="min-w-[720px] flex justify-center py-2">
                        <img id="gh-heatmap-img" 
                             src="https://ghchart.rshah.org/FF4D2D/{{ $ghUsername }}" 
                             alt="Kalender Kontribusi GitHub {{ $ghUsername }}" 
                             class="w-full h-auto filter drop-shadow-md select-none transition-transform duration-500 hover:scale-[1.01]"
                             loading="lazy">
                    </div>
                </div>
            </div>

            <!-- Bottom Split: Pinned / Active Repositories & Activity Radar -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pt-2">
                <!-- Left: Repositories List -->
                <div class="lg:col-span-7 space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">
                        Repositori Unggulan &amp; Aktif
                    </span>

                    <div id="gh-repos-list" class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <!-- Repo 1: Says-app -->
                        <div class="p-3.5 rounded-xl bg-[#161B22] border border-[#30363D] hover:border-accent-500/80 hover:shadow-[0_8px_25px_rgba(255,77,45,0.15)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-2 group/repo reveal-on-scroll delay-100">
                            <div>
                                <div class="flex items-center justify-between">
                                    <a href="https://github.com/{{ $ghUsername }}/Says-app" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-accent-400 group-hover/repo:text-accent-300 hover:underline truncate">
                                        Says-app
                                    </a>
                                    <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded-full border border-slate-700">Public</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                    LMS Sayyidah School: video online conference, tugas, ujian, modul belajar, dan invoicing.
                                </p>
                            </div>
                            <div class="flex items-center gap-3 text-[11px] text-slate-400 pt-1">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#f15a24]"></span>
                                    Blade
                                </span>
                                <span>&bull;</span>
                                <span>136 commits</span>
                            </div>
                        </div>

                        <!-- Repo 2: screen-cast -->
                        <div class="p-3.5 rounded-xl bg-[#161B22] border border-[#30363D] hover:border-accent-500/80 hover:shadow-[0_8px_25px_rgba(255,77,45,0.15)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-2 group/repo reveal-on-scroll delay-150">
                            <div>
                                <div class="flex items-center justify-between">
                                    <a href="https://github.com/{{ $ghUsername }}/screen-cast" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-accent-400 group-hover/repo:text-accent-300 hover:underline truncate">
                                        screen-cast
                                    </a>
                                    <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded-full border border-slate-700">Public</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                    High-performance screen casting utility via MediaMTX &amp; WebRTC.
                                </p>
                            </div>
                            <div class="flex items-center gap-3 text-[11px] text-slate-400 pt-1">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#dea584]"></span>
                                    Rust / JS
                                </span>
                                <span>&bull;</span>
                                <span>69 commits</span>
                            </div>
                        </div>

                        <!-- Repo 3: mind-metric -->
                        <div class="p-3.5 rounded-xl bg-[#161B22] border border-[#30363D] hover:border-accent-500/80 hover:shadow-[0_8px_25px_rgba(255,77,45,0.15)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-2 group/repo reveal-on-scroll delay-200">
                            <div>
                                <div class="flex items-center justify-between">
                                    <a href="https://github.com/{{ $ghUsername }}/mind-metric" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-accent-400 group-hover/repo:text-accent-300 hover:underline truncate">
                                        mind-metric
                                    </a>
                                    <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded-full border border-slate-700">Public</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                    Aplikasi asesmen kesehatan mental menggunakan metode Weighted Normalized Scoring.
                                </p>
                            </div>
                            <div class="flex items-center gap-3 text-[11px] text-slate-400 pt-1">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#4F5D95]"></span>
                                    PHP
                                </span>
                                <span>&bull;</span>
                                <span>Database</span>
                            </div>
                        </div>

                        <!-- Repo 4: suratrahasia -->
                        <div class="p-3.5 rounded-xl bg-[#161B22] border border-[#30363D] hover:border-accent-500/80 hover:shadow-[0_8px_25px_rgba(255,77,45,0.15)] hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between space-y-2 group/repo reveal-on-scroll delay-250">
                            <div>
                                <div class="flex items-center justify-between">
                                    <a href="https://github.com/{{ $ghUsername }}/suratrahasia" target="_blank" rel="noopener noreferrer" class="text-sm font-bold text-accent-400 group-hover/repo:text-accent-300 hover:underline truncate">
                                        suratrahasia
                                    </a>
                                    <span class="text-[10px] font-semibold text-slate-400 px-2 py-0.5 rounded-full border border-slate-700">Public</span>
                                </div>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-2">
                                    Interactive web project surat rahasia &amp; responsive UI components.
                                </p>
                            </div>
                            <div class="flex items-center gap-3 text-[11px] text-slate-400 pt-1">
                                <span class="flex items-center gap-1.5">
                                    <span class="w-2.5 h-2.5 rounded-full bg-[#f15a24]"></span>
                                    Blade
                                </span>
                                <span>&bull;</span>
                                <span>Frontend</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Activity Radar & Focus (matching screenshot with animated scanning sonar beam) -->
                <div class="lg:col-span-5 space-y-3">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-400 block">
                        Overview Aktivitas &amp; Rasio Kode
                    </span>

                    <div class="p-4 sm:p-5 rounded-xl bg-[#161B22] border border-[#30363D] h-[calc(100%-1.75rem)] flex flex-col justify-between space-y-4 reveal-on-scroll delay-200">
                        <!-- Cross / Radar Visual with Rotating Scan Beam & Sonar Beacon -->
                        <div class="relative w-full aspect-[2/1] min-h-[140px] flex items-center justify-center overflow-hidden rounded-xl bg-[#0B0F17]">
                            <!-- Concentric Radar Range Rings -->
                            <div class="absolute w-24 h-24 rounded-full border border-slate-800/80 pointer-events-none"></div>
                            <div class="absolute w-44 h-44 rounded-full border border-slate-800/40 pointer-events-none"></div>

                            <!-- Rotating Radar Scanner Sweep Beam -->
                            <div class="absolute w-44 h-44 rounded-full pointer-events-none animate-radar-sweep opacity-70"
                                 style="background: conic-gradient(from 0deg, transparent 0deg, transparent 270deg, rgba(255, 77, 45, 0.22) 360deg);"></div>

                            <!-- Horizontal Axis -->
                            <div class="absolute inset-x-8 top-1/2 h-[1px] bg-slate-700/80"></div>
                            <!-- Vertical Axis -->
                            <div class="absolute inset-y-4 left-1/2 w-[1px] bg-slate-700/80"></div>

                            <!-- Labels -->
                            <span class="absolute top-1.5 left-1/2 -translate-x-1/2 text-[9px] font-bold text-slate-400 uppercase tracking-wider">Code Review</span>
                            <span class="absolute bottom-1.5 left-1/2 -translate-x-1/2 text-[9px] font-bold text-slate-400 uppercase tracking-wider">Pull Requests</span>
                            <span class="absolute left-2 top-1/2 -translate-y-1/2 text-[9px] font-bold text-accent-400 uppercase text-right leading-tight">100%<br>Commits</span>
                            <span class="absolute right-2 top-1/2 -translate-y-1/2 text-[9px] font-bold text-slate-400 uppercase tracking-wider">Issues</span>

                            <!-- Active Commits Indicator Node with Sonar Ripples -->
                            <div class="absolute left-1/4 top-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-center">
                                <!-- Sonar expanding ripple waves -->
                                <span class="absolute w-8 h-8 rounded-full bg-accent-500/20 animate-sonar pointer-events-none"></span>
                                <span class="absolute w-4 h-4 rounded-full bg-accent-500/40 animate-ping pointer-events-none"></span>
                                <!-- Glowing core beacon dot -->
                                <span class="relative w-3.5 h-3.5 rounded-full bg-accent-500 shadow-[0_0_14px_#FF4D2D] border border-white/60 block"></span>
                            </div>
                        </div>

                        <!-- Progress Breakdown -->
                        <div class="space-y-2 pt-2 border-t border-[#21262D] text-xs">
                            <div class="flex items-center justify-between text-slate-400">
                                <span>Fokus Utama: Fullstack Engineering</span>
                                <span class="font-bold text-accent-400">95% Code Execution</span>
                            </div>
                            <div class="w-full h-2 rounded-full bg-[#21262D] overflow-hidden flex">
                                <div class="h-full bg-accent-500 w-[75%]" title="PHP / Laravel / Blade"></div>
                                <div class="h-full bg-cyan-400 w-[15%]" title="Tailwind / Frontend"></div>
                                <div class="h-full bg-amber-400 w-[10%]" title="Rust / WebRTC"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>

<!-- Dynamic Live Hydration Script -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ghUsername = "{{ $ghUsername }}";
        if (!ghUsername) return;

        // Fetch Live User Stats asynchronously
        fetch(`https://api.github.com/users/${ghUsername}`)
            .then(res => res.ok ? res.json() : null)
            .then(data => {
                if (!data) return;
                const followersEl = document.getElementById('gh-followers');
                const followingEl = document.getElementById('gh-following');
                const reposEl = document.getElementById('gh-public-repos');
                const avatarEl = document.getElementById('gh-avatar');

                if (followersEl && data.followers !== undefined) followersEl.textContent = data.followers;
                if (followingEl && data.following !== undefined) followingEl.textContent = data.following;
                if (reposEl && data.public_repos !== undefined) reposEl.textContent = data.public_repos;
                if (avatarEl && data.avatar_url) avatarEl.src = data.avatar_url;
            })
            .catch(() => {});
    });
</script>

<!-- Testimonials Section ("Testimonials that highlight my work" with Visitor Form) -->
<section id="testimonials" class="py-24 md:py-32 bg-paper-100 border-t border-paper-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 reveal-on-scroll">
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
                @if (isset($testimonials) && $testimonials->count() > 0)
                    <button id="toggle-t-form-btn" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 rounded-full border border-accent-300 bg-accent-50 hover:bg-accent-100 text-accent-700 text-xs font-semibold transition-colors shrink-0">
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tulis Ulasan
                    </button>
                @endif
            </div>
        </div>

        @if (isset($testimonials) && $testimonials->count() > 0)
            <!-- Interactive Testimonial Card Component (Only Rendered When Real Testimonials Exist) -->
            <div class="bg-white rounded-3xl border border-paper-300 p-8 sm:p-12 md:p-16 shadow-[0_10px_30px_rgba(0,0,0,0.03)] relative mb-8 reveal-scale">
                <!-- Accent Quote Mark Icon -->
                <div class="text-accent-500 text-6xl font-serif font-black leading-none mb-6 select-none">
                    &ldquo;
                </div>

                <!-- Testimonial Items (Dynamic from Database) -->
                <div id="testimonial-container">
                    @foreach ($testimonials as $tIndex => $testi)
                        <div class="testimonial-slide {{ $tIndex === 0 ? 'active' : 'hidden opacity-0' }} transition-opacity duration-300">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-8 items-center">
                                <!-- Avatar -->
                                <div class="md:col-span-3 flex justify-center md:justify-start">
                                    <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl overflow-hidden border border-paper-300 bg-paper-200 flex items-center justify-center shadow-xs">
                                        @if (!empty($testi->avatar_path) && \Illuminate\Support\Facades\Storage::disk('public')->exists($testi->avatar_path))
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
                                    @if ($testi->rating)
                                        <div class="flex items-center justify-center md:justify-start gap-1 text-amber-400 text-sm">
                                            @for ($s = 1; $s <= 5; $s++)
                                                <span>{{ $s <= $testi->rating ? '★' : '☆' }}</span>
                                            @endfor
                                            <span class="text-xs font-semibold text-slate-500 ml-1.5">{{ $testi->rating }}.0 / 5.0</span>
                                        </div>
                                    @endif
                                    <p class="text-lg sm:text-xl md:text-2xl font-bold text-slate-900 leading-relaxed">
                                        &ldquo;{{ $testi->content ?? $testi->message }}&rdquo;
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
                </div>

                @if ($testimonials->count() > 1)
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
                @endif
            </div>
        @endif

        <!-- Visitor Testimonial Submission Form (Device-Restricted via Fingerprint & IP) -->
        <div id="visitor-form-container" class="{{ (isset($testimonials) && $testimonials->count() > 0) ? 'hidden' : '' }} transition-all duration-300">
            <div class="paper-card p-6 sm:p-10 bg-white border border-paper-300 shadow-sm max-w-2xl mx-auto">
                <div class="space-y-6">
                    <div class="text-center space-y-1">
                        <span class="text-xs font-bold uppercase tracking-wider text-accent-500 block">
                            Feedback & Ulasan
                        </span>
                        <h3 class="text-2xl font-extrabold text-slate-950 tracking-tight">Tinggalkan Ulasan / Testimoni</h3>
                        <p class="text-xs sm:text-sm text-slate-500 max-w-md mx-auto">
                            Masukan Anda sangat berharga bagi kami. Setiap perangkat dibatasi mengirimkan 1 testimoni.
                        </p>
                    </div>

                    <!-- Already Submitted Notice -->
                    <div id="testimonial-already-submitted" class="hidden p-5 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs sm:text-sm text-center">
                        <p class="font-bold text-sm">✓ Anda telah mengirimkan ulasan dari perangkat ini.</p>
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
                                <input type="text" id="t-name" name="name" required placeholder="Nama Lengkap Anda"
                                       class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-paper-300 focus:outline-none focus:border-accent-500 bg-paper-50/50">
                            </div>
                            <div>
                                <label for="t-role" class="block text-xs font-semibold text-slate-700 mb-1">Jabatan & Perusahaan</label>
                                <input type="text" id="t-role" name="role" placeholder="Jabatan atau Perusahaan (Opsional)"
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
                            <textarea id="t-message-input" name="content" rows="3" required placeholder="Tuliskan pengalaman atau penilaian Anda selama bekerja sama..."
                                      class="w-full text-xs sm:text-sm px-3.5 py-2.5 rounded-xl border border-paper-300 focus:outline-none focus:border-accent-500 bg-paper-50/50"></textarea>
                        </div>

                        <div id="t-message" class="hidden text-xs font-semibold p-2.5 rounded-xl text-center"></div>

                        <div class="flex items-center justify-end gap-3 pt-2">
                            @if (isset($testimonials) && $testimonials->count() > 0)
                                <button type="button" id="cancel-t-form-btn" class="px-5 py-2 rounded-full border border-paper-300 text-slate-600 hover:text-slate-900 text-xs font-semibold">
                                    Tutup
                                </button>
                            @endif
                            <button type="submit" id="t-submit-btn" class="px-6 py-2.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-xs sm:text-sm font-semibold shadow-sm hover:shadow-md hover:shadow-accent-500/20 transition-all">
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
        <div class="relative bg-paper-warm rounded-3xl border border-paper-300 shadow-[0_15px_40px_rgba(45,35,25,0.06)] overflow-hidden reveal-scale hover:shadow-2xl transition-all duration-500">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center p-6 sm:p-12 md:p-16">
                
                <!-- Left Banner Copy -->
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left z-10 min-w-0 reveal-left">
                    <h2 class="text-2xl sm:text-4xl md:text-5xl font-extrabold text-slate-950 tracking-tight leading-tight">
                        Let's Build Something Truly<br>
                        <span class="italic font-bold text-accent-500">Meaningful Together</span>
                    </h2>
                    
                    <p class="text-sm sm:text-base text-slate-600 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
                        Whether you are launching a brand-new venture, elevating an existing digital ecosystem, or seeking expert product consulting, I am excited to connect.
                    </p>

                    <div class="pt-2">
                        <a href="mailto:{{ $user->email_contact ?: ($user->email ?: 'thoriqpasya860@gmail.com') }}" class="inline-flex items-center gap-2 px-8 py-3.5 rounded-full bg-accent-500 hover:bg-accent-600 text-white font-semibold text-sm sm:text-base shadow-lg shadow-accent-500/30 hover:shadow-xl hover:shadow-accent-500/40 hover:-translate-y-0.5 transition-all">
                            Start a Project
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- Right Banner Cutout Image -->
                <div class="lg:col-span-5 flex justify-center lg:justify-end z-10 reveal-right delay-100">
                    <div class="relative w-60 h-68 sm:w-72 sm:h-80 md:w-80 md:h-96 max-w-full overflow-hidden rounded-2xl group">
                        @if ($user->cta_image_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($user->cta_image_path))
                            <img src="{{ asset('storage/' . $user->cta_image_path) }}" 
                                 alt="Let's build together" 
                                 class="w-full h-full object-cover object-top drop-shadow-xl group-hover:scale-105 transition-transform duration-700">
                        @else
                            <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=800&q=80" 
                                 alt="Let's build together" 
                                 class="w-full h-full object-cover object-top drop-shadow-xl group-hover:scale-105 transition-transform duration-700">
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

            // Ensure content field is explicitly filled
            const msgVal = document.getElementById('t-message-input')?.value || '';
            if (!formData.get('content')) formData.set('content', msgVal);
            if (!formData.get('message')) formData.set('message', msgVal);

            // Fetch CSRF token
            const csrfToken = document.querySelector('input[name="_token"]')?.value || '';

            try {
                const response = await fetch('{{ route("testimonials.store") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                let data = null;
                try {
                    data = await response.json();
                } catch (parseErr) {
                    data = null;
                }

                if (response.ok && data && data.success) {
                    localStorage.setItem('portfolio_testimonial_submitted', 'true');
                    tForm.classList.add('hidden');
                    tAlready.classList.remove('hidden');

                    alert('Terima kasih! Ulasan Anda berhasil dikirimkan.');
                    location.reload();
                } else {
                    tMessage.classList.remove('hidden');
                    tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                    
                    if (data && data.message) {
                        tMessage.innerText = data.message;
                    } else if (response.status === 419) {
                        tMessage.innerText = 'Sesi Anda telah kedaluwarsa. Silakan muat ulang (refresh) halaman lalu kirim kembali.';
                    } else if (response.status === 429) {
                        tMessage.innerText = (data && data.message) ? data.message : 'Anda sudah pernah mengirimkan testimoni dari perangkat ini.';
                    } else {
                        tMessage.innerText = 'Terjadi kesalahan pada server (Kode: ' + response.status + '). Silakan refresh dan coba lagi.';
                    }

                    tSubmitBtn.disabled = false;
                    tSubmitBtn.innerText = 'Kirim Ulasan';
                }
            } catch (err) {
                tMessage.classList.remove('hidden');
                tMessage.className = 'text-xs font-semibold p-2.5 rounded-xl text-center bg-rose-50 text-rose-700 border border-rose-200';
                tMessage.innerText = 'Gagal terhubung ke server. Pastikan koneksi internet stabil dan coba muat ulang halaman.';
                tSubmitBtn.disabled = false;
                tSubmitBtn.innerText = 'Kirim Ulasan';
            }
        });
    }
});
</script>
@endsection
