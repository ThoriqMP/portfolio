<!-- Luxury Kinetic Preloader: THORIQ MUHAMMAD PASYA, PORTFOLIO -->
<div id="preloader" 
     class="fixed inset-0 z-[99999] bg-[#07090E] text-white flex flex-col justify-between p-6 sm:p-10 md:p-14 overflow-hidden select-none cursor-pointer"
     aria-label="Loading screen"
     title="Klik di mana saja atau tekan ESC untuk langsung masuk">

    <!-- Ambient Glow Orbs -->
    <div class="absolute -top-32 -left-32 w-80 sm:w-[480px] h-80 sm:h-[480px] bg-accent-500/10 rounded-full blur-[130px] pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-80 sm:w-[500px] h-80 sm:h-[500px] bg-accent-500/12 rounded-full blur-[150px] pointer-events-none"></div>
    <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,transparent_0%,rgba(0,0,0,0.6)_100%)] pointer-events-none"></div>

    <!-- Micro Paper Noise Texture matching main aesthetic -->
    <div class="absolute inset-0 opacity-[0.035] pointer-events-none" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=\'0 0 400 400\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cfilter id=\'noiseFilter\'%3E%3CfeTurbulence type=\'fractalNoise\' baseFrequency=\'0.65\' numOctaves=\'3\' stitchTiles=\'stitch\'/%3E%3C/filter%3E%3Crect width=\'100%25\' height=\'100%25\' filter=\'url(%23noiseFilter)\'/%3E%3C/svg%3E');"></div>

    <!-- Top Bar: Brand Identifier & Status -->
    <div class="relative z-10 flex items-center justify-between w-full max-w-7xl mx-auto pt-1 sm:pt-2">
        <div class="flex items-center gap-2.5">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-accent-500"></span>
            </span>
            <span class="text-[11px] sm:text-xs font-bold uppercase tracking-widest text-slate-300">
                THORIQ MUHAMMAD PASYA
            </span>
        </div>
        <div class="flex items-center gap-2">
            <span class="hidden sm:inline-block text-[10px] font-mono uppercase tracking-wider text-slate-500 border border-slate-800/80 px-2.5 py-1 rounded-full bg-slate-900/60 backdrop-blur-xs">
                JAKARTA / UTC+7
            </span>
            <span class="text-[10px] font-mono uppercase tracking-wider text-accent-400 border border-accent-500/30 px-2.5 py-1 rounded-full bg-accent-500/10 backdrop-blur-xs font-bold">
                2026 EDITION
            </span>
        </div>
    </div>

    <!-- Center Stage: 4 Kinetic Stacked Lines Alternating Left & Right -->
    <div class="relative z-10 w-full max-w-6xl mx-auto my-auto py-4 sm:py-6 flex flex-col justify-center">
        
        <!-- Line 1: THORIQ (Masuk dari Kiri) -->
        <div class="overflow-hidden py-0.5 sm:py-1">
            <div class="preloader-line-1 flex items-baseline justify-start">
                <span class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tight text-white leading-[0.9] drop-shadow-[0_4px_20px_rgba(0,0,0,0.6)]">
                    THORIQ
                </span>
            </div>
        </div>

        <!-- Line 2: MUHAMMAD (Masuk dari Kanan) -->
        <div class="overflow-hidden py-0.5 sm:py-1">
            <div class="preloader-line-2 flex items-baseline justify-end">
                <span class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tight text-slate-200/95 leading-[0.9] drop-shadow-[0_4px_20px_rgba(0,0,0,0.6)]">
                    MUHAMMAD
                </span>
            </div>
        </div>

        <!-- Line 3: PASYA (Masuk dari Kiri) -->
        <div class="overflow-hidden py-0.5 sm:py-1">
            <div class="preloader-line-3 flex items-baseline justify-start">
                <span class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tight text-white leading-[0.9] drop-shadow-[0_4px_20px_rgba(0,0,0,0.6)]">
                    PASYA
                </span>
            </div>
        </div>

        <!-- Line 4: PORTFOLIO (Masuk dari Kanan dengan Signature Accent Orange) -->
        <div class="overflow-hidden py-0.5 sm:py-1">
            <div class="preloader-line-4 flex items-center justify-end gap-2 sm:gap-4 md:gap-6">
                <span class="hidden sm:inline-block h-1 sm:h-1.5 w-12 sm:w-24 bg-gradient-to-r from-accent-500/20 to-accent-500 rounded-full"></span>
                <span class="text-4xl sm:text-6xl md:text-8xl lg:text-9xl font-black uppercase tracking-tight text-accent-500 leading-[0.9] drop-shadow-[0_0_35px_rgba(255,77,45,0.45)]">
                    PORTFOLIO
                </span>
            </div>
        </div>

    </div>

    <!-- Bottom Bar: Glowing Progress Line, Percentage Ticker & Skip Hint -->
    <div class="relative z-10 w-full max-w-7xl mx-auto pb-1 sm:pb-2 space-y-3">
        <!-- Thin Glowing Progress Line Track -->
        <div class="w-full h-[2px] bg-slate-800/80 rounded-full overflow-hidden relative">
            <div id="preloader-progress-bar" 
                 class="h-full bg-gradient-to-r from-accent-600 via-accent-500 to-amber-400 rounded-full shadow-[0_0_12px_rgba(255,77,45,0.85)] transition-all duration-75 ease-out" 
                 style="width: 0%;"></div>
        </div>

        <!-- Bottom Metadata Row -->
        <div class="flex items-center justify-between text-xs font-mono text-slate-400">
            <div class="flex items-center gap-2">
                <span id="preloader-status-dot" class="w-1.5 h-1.5 rounded-full bg-accent-500 animate-pulse"></span>
                <span id="preloader-status-text" class="text-[10px] sm:text-xs uppercase tracking-wider text-slate-400">INITIALIZING EXPERIENCE</span>
            </div>

            <div class="hidden md:block text-[10px] text-slate-500 uppercase tracking-widest">
                [ KLIK DI MANA SAJA / ESC UNTUK SKIP ]
            </div>

            <div class="flex items-center gap-1.5 font-bold text-slate-200">
                <span class="text-[10px] sm:text-[11px] text-slate-500 font-mono">LOADING</span>
                <span id="preloader-counter" class="text-sm sm:text-base font-black text-white tabular-nums tracking-wider min-w-[3.2rem] text-right">0%</span>
            </div>
        </div>
    </div>
</div>

<!-- Preloader Automation Script -->
<script>
    (function() {
        const preloader = document.getElementById('preloader');
        if (!preloader) return;

        const progressBar = document.getElementById('preloader-progress-bar');
        const counter = document.getElementById('preloader-counter');
        const statusText = document.getElementById('preloader-status-text');
        let dismissed = false;

        function dismissPreloader() {
            if (dismissed) return;
            dismissed = true;

            // Instantly snap to 100%
            if (progressBar) progressBar.style.width = '100%';
            if (counter) counter.textContent = '100%';
            if (statusText) statusText.textContent = 'READY';

            // Unlock hero animations right as curtain starts lifting
            document.body.classList.remove('preloader-active');
            document.body.classList.add('page-loaded');

            // Lift curtain upwards
            preloader.classList.add('preloader-curtain-up');

            // Clean up preloader from DOM after transition finishes
            setTimeout(function() {
                preloader.style.display = 'none';
                if (preloader.parentNode) {
                    preloader.parentNode.removeChild(preloader);
                }
            }, 1250);
        }

        // Allow click or tap to dismiss immediately
        preloader.addEventListener('click', dismissPreloader);

        // Allow ESC key to dismiss immediately
        window.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') dismissPreloader();
        });

        // Animate counter from 0 to 100 with smooth easeOutCubic
        const duration = 3000; // 3.0s smooth duration
        const startTime = performance.now();

        function tick(now) {
            if (dismissed) return;
            const elapsed = now - startTime;
            const progress = Math.min(elapsed / duration, 1);
            // Cubic ease-out
            const ease = 1 - Math.pow(1 - progress, 3);
            const currentPercent = Math.min(Math.round(ease * 100), 100);

            if (progressBar) progressBar.style.width = currentPercent + '%';
            if (counter) counter.textContent = currentPercent + '%';

            if (currentPercent > 30 && currentPercent < 70) {
                if (statusText) statusText.textContent = 'LOADING ASSETS';
            } else if (currentPercent >= 70 && currentPercent < 100) {
                if (statusText) statusText.textContent = 'FINALIZING';
            }

            if (progress < 1) {
                requestAnimationFrame(tick);
            } else {
                if (statusText) statusText.textContent = 'READY';
                // Hold at 100% for 500ms so user can appreciate the completed composition
                setTimeout(dismissPreloader, 500);
            }
        }

        requestAnimationFrame(tick);

        // Fail-safe timeout: dismiss after 5.5s under any circumstances
        setTimeout(dismissPreloader, 5500);
    })();
</script>

<noscript>
    <style>
        #preloader { display: none !important; }
        body.preloader-active { overflow: auto !important; }
        body.preloader-active .animate-morph-left,
        body.preloader-active .animate-morph-portrait,
        body.preloader-active .animate-morph-glass,
        body.preloader-active .animate-morph-tool,
        body.preloader-active .animate-morph-right,
        body.preloader-active .animate-morph-pill,
        body.preloader-active .animate-morph-social,
        body.preloader-active .animate-aura-bloom {
            animation-play-state: running !important;
        }
    </style>
</noscript>

