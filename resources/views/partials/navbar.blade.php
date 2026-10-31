<!-- Header / Navigation (Floating Paper Pill Bar) -->
<header id="main-header" class="fixed top-3 sm:top-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-1.25rem)] sm:w-[calc(100%-2rem)] max-w-6xl transition-all duration-300">
    <div class="glass-header rounded-full border border-paper-300 shadow-[0_4px_20px_rgba(45,35,25,0.05)] px-3.5 sm:px-6 py-2 sm:py-3 flex items-center justify-between">
        <!-- Luxury Brand Identity: Monogram Crest + Bespoke Extended Wordmark -->
        <a href="{{ Route::is('home') ? '#hero' : route('home') }}" class="group flex items-center gap-2.5 sm:gap-3 select-none shrink-0 py-1" aria-label="THORIQ">
            <!-- Luxury Monogram Icon Emblem -->
            <div class="relative w-8 h-8 sm:w-9 sm:h-9 rounded-xl bg-slate-950 p-0.5 shadow-md shadow-slate-950/20 group-hover:shadow-accent-500/25 transition-all duration-300 group-hover:scale-105 border border-slate-800 group-hover:border-accent-500/60 flex items-center justify-center shrink-0">
                <!-- Inner Specular Light -->
                <div class="absolute inset-0 rounded-[11px] bg-gradient-to-tr from-white/[0.04] to-white/[0.14] pointer-events-none"></div>

                <!-- Architectural Monogram T -->
                <svg class="w-4 h-4 sm:w-4.5 sm:h-4.5 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M 5 7 L 27 7 L 25.5 11.5 L 18 11.5 L 18 26 L 14 26 L 14 11.5 L 6.5 11.5 Z" fill="url(#navLuxuryT)"/>
                    <path d="M 6 7 L 26 7 L 25 8.5 L 7 8.5 Z" fill="#FFFFFF" fill-opacity="0.7"/>
                    <defs>
                        <linearGradient id="navLuxuryT" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#FFFFFF"/>
                            <stop offset="60%" stop-color="#F1F5F9"/>
                            <stop offset="100%" stop-color="#94A3B8"/>
                        </linearGradient>
                    </defs>
                </svg>

                <!-- Diamond Sparkle Accent on Top Right -->
                <span class="absolute -top-1 -right-1 flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-accent-500"></span>
                </span>
            </div>

            <!-- Brand Name Wordmark -->
            <span class="font-brand font-black text-sm sm:text-base tracking-[0.3em] uppercase text-slate-950 group-hover:text-accent-500 transition-colors duration-200">
                THORIQ
            </span>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-1 lg:gap-2">
            <a href="{{ Route::is('home') ? '#hero' : route('home') . '#hero' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                Home
            </a>
            <a href="{{ Route::is('home') ? '#about' : route('home') . '#about' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                About Me
            </a>
            <a href="{{ Route::is('home') ? '#services' : route('home') . '#services' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                Services
            </a>
            <a href="{{ Route::is('home') ? '#experience' : route('home') . '#experience' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                Experiences
            </a>
            <a href="{{ Route::is('home') ? '#projects' : route('home') . '#projects' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                Projects
            </a>
            <a href="{{ Route::is('home') ? '#testimonials' : route('home') . '#testimonials' }}" class="nav-item px-3.5 py-1.5 text-xs lg:text-sm font-medium text-slate-600 hover:text-accent-500 rounded-full transition-colors">
                Testimonials
            </a>
        </nav>

        <!-- Right Side: Contact CTA & Mobile Menu Toggle -->
        <div class="flex items-center gap-2 sm:gap-3">
            <a href="{{ Route::is('home') ? '#contact' : route('home') . '#contact' }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-xs sm:text-sm font-semibold shadow-sm hover:shadow-md hover:shadow-accent-500/20 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                Let's Talk
            </a>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-full text-slate-700 hover:bg-paper-200 hover:text-accent-500 transition-colors" aria-label="Toggle navigation menu">
                <svg id="menu-icon-open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg id="menu-icon-close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Dropdown Menu -->
    <div id="mobile-menu" class="hidden md:hidden mt-2 glass-header rounded-2xl border border-paper-300 shadow-xl p-4 transition-all duration-200">
        <nav class="flex flex-col space-y-1">
            <a href="{{ Route::is('home') ? '#hero' : route('home') . '#hero' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                Home
            </a>
            <a href="{{ Route::is('home') ? '#about' : route('home') . '#about' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                About Me
            </a>
            <a href="{{ Route::is('home') ? '#services' : route('home') . '#services' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                Services
            </a>
            <a href="{{ Route::is('home') ? '#experience' : route('home') . '#experience' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                Experiences
            </a>
            <a href="{{ Route::is('home') ? '#projects' : route('home') . '#projects' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                Projects
            </a>
            <a href="{{ Route::is('home') ? '#testimonials' : route('home') . '#testimonials' }}" class="mobile-nav-item px-4 py-2.5 text-sm font-medium text-slate-700 hover:bg-accent-50 hover:text-accent-500 rounded-xl transition-colors">
                Testimonials
            </a>
            <a href="{{ Route::is('home') ? '#contact' : route('home') . '#contact' }}" class="mt-2 text-center py-2.5 rounded-full bg-accent-500 text-white font-semibold text-sm shadow-sm">
                Let's Talk
            </a>
        </nav>
    </div>
</header>
