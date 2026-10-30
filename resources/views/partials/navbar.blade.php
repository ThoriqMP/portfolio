<!-- Header / Navigation (Modern Glassmorphic Floating Pill Bar) -->
<header id="main-header" class="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-6xl transition-all duration-300">
    <div class="glass-header rounded-full border border-slate-200/80 shadow-[0_4px_25px_rgba(0,0,0,0.06)] px-4 sm:px-6 py-2.5 sm:py-3 flex items-center justify-between">
        <!-- Brand Logo -->
        <a href="{{ Route::is('home') ? '#hero' : route('home') }}" class="group flex items-center gap-1.5 select-none shrink-0">
            <span class="font-extrabold text-base sm:text-lg tracking-tight uppercase text-slate-900 group-hover:text-accent-500 transition-colors">
                {{ $user->name ?? 'ETHAN WARD' }}
            </span>
            <span class="w-2 h-2 rounded-full bg-accent-500 animate-pulse"></span>
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
            <a href="{{ Route::is('home') ? '#contact' : route('home') . '#contact' }}" class="hidden sm:inline-flex items-center justify-center px-5 py-2 rounded-full bg-accent-500 hover:bg-accent-600 text-white text-xs sm:text-sm font-semibold shadow-md shadow-accent-500/25 hover:shadow-lg hover:shadow-accent-500/35 hover:-translate-y-0.5 active:translate-y-0 transition-all duration-150">
                Contact Me
            </a>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-btn" type="button" class="md:hidden p-2 rounded-full text-slate-700 hover:bg-slate-100 hover:text-accent-500 transition-colors" aria-label="Toggle navigation menu">
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
    <div id="mobile-menu" class="hidden md:hidden mt-2 glass-header rounded-2xl border border-slate-200/80 shadow-xl p-4 transition-all duration-200">
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
            <a href="{{ Route::is('home') ? '#contact' : route('home') . '#contact' }}" class="mt-2 text-center py-2.5 rounded-full bg-accent-500 text-white font-semibold text-sm shadow-md shadow-accent-500/25">
                Contact Me
            </a>
        </nav>
    </div>
</header>
