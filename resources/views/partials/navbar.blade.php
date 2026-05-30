<!-- Header / Navigation (Floating Brutalist Bar Component) -->
<header class="fixed z-50 left-1/2 -translate-x-1/2 rounded-none bg-white border-3 border-black transition-all duration-300 w-[calc(100%-4rem)] max-w-[200px] h-10 bottom-4 shadow-[4px_-4px_0px_#000000] md:top-6 md:bottom-auto md:w-[calc(100%-2rem)] md:max-w-7xl md:h-16 md:border-4 md:shadow-[8px_8px_0px_#000000]">
    <!-- Desktop Header Layout (Only visible on md and up) -->
    <div class="hidden md:flex w-full px-6 items-center justify-between h-full">
        <!-- Branding -->
        <div class="flex items-center gap-4 overflow-hidden">
            <a href="{{ route('home') }}" class="text-xl font-black tracking-tighter uppercase text-black flex items-center gap-0.5 select-none shrink-0">
                {{ substr($user->name, 0, 8) }}<span class="text-[#ff5722]">_</span>
            </a>
        </div>

        <!-- Navigation Links -->
        <nav class="flex items-center gap-2.5 shrink-0">
            <a href="{{ Route::is('home') ? '#about' : route('home') . '#about' }}" id="nav-link-about" class="px-3 py-1.5 text-xs font-black uppercase border-2 border-transparent hover:border-black hover:bg-[#ff5722] hover:text-black transition-all">Tentang</a>
            <a href="{{ Route::is('home') ? '#projects' : route('home') . '#projects' }}" id="nav-link-projects" class="px-3 py-1.5 text-xs font-black uppercase border-2 border-transparent hover:border-black hover:bg-[#ff5722] hover:text-black transition-all">Proyek</a>
            <a href="{{ Route::is('home') ? '#timeline' : route('home') . '#timeline' }}" id="nav-link-timeline" class="px-3 py-1.5 text-xs font-black uppercase border-2 border-transparent hover:border-black hover:bg-[#ff5722] hover:text-black transition-all">Karir</a>
        </nav>
    </div>

    <!-- Mobile Header Layout (Only visible on mobile/tablet) -->
    <div class="flex md:hidden w-full items-center justify-center h-full px-4">
        <div class="relative overflow-hidden w-full h-5 flex items-center justify-center font-black text-[10px] sm:text-xs uppercase text-black tracking-widest">
            <span id="active-section-name-mobile" class="absolute left-1/2 -translate-x-1/2 inline-block whitespace-nowrap transition-all duration-200">
                {{ Route::is('home') ? '// BERANDA //' : '// DETAIL PROYEK //' }}
            </span>
        </div>
    </div>
</header>
