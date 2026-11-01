<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} &mdash; {{ $user->title ?? 'Digital Product Designer' }}</title>
    
    <!-- Meta Tags for SEO -->
    <meta name="description" content="Portofolio resmi {{ $user->name }}. Berfokus pada perancangan produk digital, UI/UX, dan pengembangan aplikasi web.">
    <meta name="keywords" content="Portfolio, Fullstack Web Developer, UI/UX Designer, Laravel, Tailwind CSS, Web Design">
    <meta name="author" content="{{ $user->name }}">

    <!-- App Favicon & Brand Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">

    <!-- Google Fonts: Plus Jakarta Sans, Unbounded (Futuristic Extended Display) & Syncopate -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700;1,800&family=Unbounded:wght@700;800;900&family=Syncopate:wght@700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        brand: ['"Unbounded"', '"Syncopate"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            50: '#FFF5F0',
                            100: '#FFE8DF',
                            200: '#FFD2C2',
                            300: '#FFAC93',
                            400: '#FF7B58',
                            500: '#FF4D2D', // Primary vibrant reddish-orange
                            600: '#E63D1F',
                            700: '#C42F13',
                            800: '#9E2711',
                            900: '#7F2413',
                        },
                        paper: {
                            50: '#FDFBF8',
                            100: '#FAF8F5', // Base paper
                            200: '#F4EFEB', // Warm paper
                            300: '#EBE4DB', // Border line
                            400: '#D5CCBF',
                        },
                        dark: {
                            800: '#141824',
                            900: '#0C101B',
                            950: '#070A12',
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        /* Prevent any unwanted horizontal overflow */
        html, body {
            overflow-x: hidden;
            max-width: 100vw;
            width: 100%;
        }

        /* Base Paper Texture using SVG Fractal Noise */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.038'/%3E%3C/svg%3E");
            color: #0F172A;
        }

        ::selection {
            background-color: #FF4D2D;
            color: #ffffff;
        }

        /* Glassmorphism header with soft paper tint */
        .glass-header {
            background: rgba(250, 248, 245, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        /* Warm tinted paper for contrast sections */
        .bg-paper-warm {
            background-color: #F4EFEB;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.045'/%3E%3C/svg%3E");
        }

        /* Modern card with smooth paper tactile border */
        .modern-card {
            background-color: #FFFFFF;
            border: 1px solid rgba(226, 232, 240, 0.85);
            border-radius: 1.5rem;
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modern-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.1), 0 0 25px -5px rgba(255, 77, 45, 0.12);
            border-color: rgba(255, 77, 45, 0.4);
        }

        /* Organic paper card */
        .paper-card {
            background-color: #FFFFFF;
            border: 1px solid #E8E3D8;
            border-radius: 1.5rem;
            box-shadow: 0 4px 18px -2px rgba(45, 35, 25, 0.04);
            transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .paper-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 32px -4px rgba(45, 35, 25, 0.09), 0 0 20px -3px rgba(255, 77, 45, 0.1);
            border-color: rgba(255, 77, 45, 0.4);
        }

        /* ======================================================== */
        /* LUXURY ANIMATIONS & MICRO-INTERACTIONS                   */
        /* ======================================================== */

        /* Floating levitation for Hero Glass Card */
        @keyframes floatLevitate {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-10px) rotate(0.4deg);
            }
        }
        .animate-float-levitate {
            animation: floatLevitate 5.5s ease-in-out infinite;
        }

        /* Ambient breathing aura glow */
        @keyframes auraPulse {
            0%, 100% {
                opacity: 0.12;
                transform: scale(1);
            }
            50% {
                opacity: 0.22;
                transform: scale(1.08);
            }
        }
        .animate-aura-pulse {
            animation: auraPulse 7s ease-in-out infinite;
        }

        /* GitHub Radar beam sweep */
        @keyframes radarSweep {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(360deg);
            }
        }
        .animate-radar-sweep {
            animation: radarSweep 5s linear infinite;
            transform-origin: center center;
        }

        /* Sonar radar ping beacon */
        @keyframes sonarPing {
            0% {
                transform: scale(0.85);
                opacity: 0.9;
            }
            70% {
                opacity: 0.3;
            }
            100% {
                transform: scale(3.2);
                opacity: 0;
            }
        }
        .animate-sonar {
            animation: sonarPing 2.4s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        /* Scroll Reveal Utility Classes (GPU accelerated) */
        .reveal-on-scroll {
            opacity: 0;
            transform: translate3d(0, 32px, 0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-on-scroll.revealed {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        .reveal-left {
            opacity: 0;
            transform: translate3d(-36px, 0, 0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-left.revealed {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        .reveal-right {
            opacity: 0;
            transform: translate3d(36px, 0, 0);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-right.revealed {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }

        .reveal-scale {
            opacity: 0;
            transform: scale(0.93);
            transition: opacity 0.85s cubic-bezier(0.16, 1, 0.3, 1), transform 0.85s cubic-bezier(0.16, 1, 0.3, 1);
            will-change: opacity, transform;
        }
        .reveal-scale.revealed {
            opacity: 1;
            transform: scale(1);
        }

        /* Stagger Delays for Transitions & Animations */
        .delay-50 { animation-delay: 50ms; transition-delay: 50ms; }
        .delay-75 { animation-delay: 75ms; transition-delay: 75ms; }
        .delay-100 { animation-delay: 100ms; transition-delay: 100ms; }
        .delay-150 { animation-delay: 150ms; transition-delay: 150ms; }
        .delay-200 { animation-delay: 200ms; transition-delay: 200ms; }
        .delay-250 { animation-delay: 250ms; transition-delay: 250ms; }
        .delay-300 { animation-delay: 300ms; transition-delay: 300ms; }
        .delay-350 { animation-delay: 350ms; transition-delay: 350ms; }
        .delay-400 { animation-delay: 400ms; transition-delay: 400ms; }
        .delay-450 { animation-delay: 450ms; transition-delay: 450ms; }
        .delay-500 { animation-delay: 500ms; transition-delay: 500ms; }
        .delay-600 { animation-delay: 600ms; transition-delay: 600ms; }
        .delay-700 { animation-delay: 700ms; transition-delay: 700ms; }

        /* ======================================================== */
        /* HERO MORPH-IN ENTRANCE SUITE (PAGE LOAD CHOREOGRAPHY)    */
        /* ======================================================== */

        /* 1. Left Hero Column: Morphs in with elastic slide, blur fade & scale */
        @keyframes heroMorphLeft {
            0% {
                opacity: 0;
                transform: translate3d(-48px, 24px, 0) scale(0.92);
                filter: blur(12px);
            }
            55% {
                filter: blur(0);
            }
            85% {
                transform: translate3d(4px, -2px, 0) scale(1.01);
            }
            100% {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
                filter: blur(0);
            }
        }
        .animate-morph-left {
            animation: heroMorphLeft 1.1s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        /* 2. Middle Portrait Cutout: Morphs from organic capsule with blur into sharp card */
        @keyframes heroMorphPortrait {
            0% {
                opacity: 0;
                transform: translate3d(0, 50px, 0) scale(0.85);
                border-radius: 4rem;
                filter: blur(16px) contrast(1.1);
            }
            55% {
                filter: blur(0) contrast(1.02);
            }
            80% {
                transform: translate3d(0, -6px, 0) scale(1.02);
                border-radius: 2rem;
            }
            100% {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
                border-radius: 1.5rem;
                filter: blur(0) contrast(1);
            }
        }
        .animate-morph-portrait {
            animation: heroMorphPortrait 1.2s cubic-bezier(0.16, 1, 0.3, 1) 0.12s both;
        }

        /* 3. Glassmorphism Tools Card: Dramatic Morph from frosted capsule with sheen sweep */
        @keyframes heroMorphGlass {
            0% {
                opacity: 0;
                transform: translate3d(0, 55px, 0) scale(0.78);
                border-radius: 9999px;
                filter: blur(14px) brightness(1.2);
                box-shadow: 0 0 0 rgba(255, 77, 45, 0);
            }
            50% {
                filter: blur(0);
            }
            75% {
                transform: translate3d(0, -8px, 0) scale(1.04);
                border-radius: 2.2rem;
                box-shadow: 0 20px 45px rgba(255, 77, 45, 0.22);
            }
            100% {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
                border-radius: 1.5rem;
                filter: blur(0) brightness(1);
                box-shadow: 0 16px 36px rgba(15, 23, 42, 0.12);
            }
        }
        .animate-morph-glass {
            animation: heroMorphGlass 1.25s cubic-bezier(0.16, 1, 0.3, 1) 0.3s both;
        }

        /* 4. Individual Tool Icons: Staggered Morph Pop */
        @keyframes heroMorphTool {
            0% {
                opacity: 0;
                transform: scale(0.3) translateY(14px);
                filter: blur(4px);
            }
            70% {
                transform: scale(1.18) translateY(-2px);
            }
            100% {
                opacity: 1;
                transform: scale(1) translateY(0);
                filter: blur(0);
            }
        }
        .animate-morph-tool {
            animation: heroMorphTool 0.65s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        /* 5. Right Hero Column: Morphs in with elastic slide from right */
        @keyframes heroMorphRight {
            0% {
                opacity: 0;
                transform: translate3d(48px, 24px, 0) scale(0.92);
                filter: blur(12px);
            }
            55% {
                filter: blur(0);
            }
            85% {
                transform: translate3d(-4px, -2px, 0) scale(1.01);
            }
            100% {
                opacity: 1;
                transform: translate3d(0, 0, 0) scale(1);
                filter: blur(0);
            }
        }
        .animate-morph-right {
            animation: heroMorphRight 1.1s cubic-bezier(0.16, 1, 0.3, 1) 0.22s both;
        }

        /* 6. Title Pill & Badge Elastic Morph Pop */
        @keyframes heroMorphPill {
            0% {
                opacity: 0;
                transform: scale(0.65) rotate(-3deg);
                filter: blur(8px);
            }
            65% {
                transform: scale(1.08) rotate(1deg);
                filter: blur(0);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
                filter: blur(0);
            }
        }
        .animate-morph-pill {
            animation: heroMorphPill 0.85s cubic-bezier(0.34, 1.56, 0.64, 1) 0.28s both;
        }

        /* 7. Social Pills Cascade Morph */
        @keyframes heroMorphSocial {
            0% {
                opacity: 0;
                transform: scale(0.35) rotate(-15deg);
            }
            75% {
                transform: scale(1.22) rotate(4deg);
            }
            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }
        .animate-morph-social {
            animation: heroMorphSocial 0.65s cubic-bezier(0.34, 1.56, 0.64, 1) both;
        }

        /* 8. Specular Light Ray Sheen Sweep across Card */
        @keyframes morphShimmerWipe {
            0% {
                transform: translateX(-150%) skewX(-25deg);
                opacity: 0;
            }
            35% {
                opacity: 0.75;
            }
            100% {
                transform: translateX(250%) skewX(-25deg);
                opacity: 0;
            }
        }
        .morph-shimmer {
            position: relative;
            overflow: hidden;
        }
        .morph-shimmer::after {
            content: '';
            position: absolute;
            inset: -50% -100%;
            background: linear-gradient(90deg, transparent 0%, rgba(255, 255, 255, 0.7) 50%, transparent 100%);
            pointer-events-none;
            animation: morphShimmerWipe 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.5s both;
        }

        /* 9. Background Aura Bloom */
        @keyframes heroAuraBloom {
            0% {
                opacity: 0;
                transform: translate(-50%, -20%) scale(0.35);
            }
            50% {
                opacity: 0.28;
                transform: translate(-50%, 0) scale(1.15);
            }
            100% {
                opacity: 0.15;
                transform: translate(-50%, 0) scale(1);
            }
        }
        .animate-aura-bloom {
            animation: heroAuraBloom 1.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        }

        /* Card interactive lift & glow */
        .hover-lift {
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 36px -10px rgba(15, 23, 42, 0.12);
        }

        /* Respect Reduced Motion Preferences */
        @media (prefers-reduced-motion: reduce) {
            .reveal-on-scroll, .reveal-left, .reveal-right, .reveal-scale {
                opacity: 1 !important;
                transform: none !important;
                transition: none !important;
            }
            .animate-float-levitate, .animate-radar-sweep, .animate-sonar, .animate-aura-pulse,
            .animate-morph-left, .animate-morph-portrait, .animate-morph-glass, .animate-morph-tool,
            .animate-morph-right, .animate-morph-pill, .animate-morph-social, .animate-aura-bloom {
                animation: none !important;
                opacity: 1 !important;
                transform: none !important;
                filter: none !important;
            }
            .morph-shimmer::after {
                display: none !important;
            }
        }

        /* Section scroll offset for fixed pill navbar */
        section {
            scroll-margin-top: 5.5rem;
        }

        /* Clean scrollbar styling */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #FAF8F5;
        }
        ::-webkit-scrollbar-thumb {
            background: #D8D2C5;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #FF4D2D;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col antialiased selection:bg-accent-500 selection:text-white w-full max-w-full overflow-x-hidden relative">

    <!-- Header / Navigation (Floating Pill Navbar) -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow w-full max-w-full overflow-x-hidden">
        @yield('content')
    </main>

    <!-- Footer (Deep Dark Luxury Section with Giant Faded Watermark from Mockup) -->
    <footer id="contact" class="bg-dark-950 text-white pt-24 pb-12 relative overflow-hidden border-t border-slate-800/80 w-full max-w-full">
        <!-- Giant Watermark Background Text at bottom of footer (from mockup) -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 select-none text-[6rem] sm:text-[12rem] md:text-[18rem] lg:text-[24rem] font-black text-white/[0.035] leading-none tracking-tighter uppercase pointer-events-none z-0 whitespace-nowrap overflow-hidden">
            {{ strtoupper(explode(' ', $user->name ?? 'ETHAN')[0]) }}
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <!-- Top Footer Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 pb-20 border-b border-slate-800/80 items-start">
                <!-- Left: Big CTA & Direct Contact -->
                <div class="lg:col-span-7 xl:col-span-7 space-y-6 min-w-0">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-accent-400">
                        <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                        Let's Talk
                    </span>
                    
                    <div class="min-w-0">
                        <a href="mailto:{{ $user->email_contact ?: ($user->email ?: 'thoriqpasya860@gmail.com') }}" class="text-xl sm:text-2xl md:text-3xl lg:text-3xl xl:text-4xl font-extrabold text-white hover:text-accent-400 transition-colors tracking-tight block break-all sm:break-normal max-w-full">
                            {{ $user->email_contact ?: ($user->email ?: 'thoriqpasya860@gmail.com') }}
                        </a>
                        <p class="text-slate-400 text-sm mt-3 max-w-md leading-relaxed font-normal">
                            Have an idea, a project inquiry, or just want to chat? Send me an email and let's craft something remarkable together.
                        </p>
                    </div>

                    <!-- Social Media Links (Modern Circular Pills) -->
                    <div class="flex items-center gap-3 pt-4 flex-wrap">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" title="{{ $social->name }}" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200">
                                    @include('partials.social-icon', ['social' => $social])
                                </a>
                            @endforeach
                        @else
                            <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="LinkedIn">
                                @include('partials.social-icon', ['type' => 'linkedin'])
                            </a>

                            <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="GitHub">
                                @include('partials.social-icon', ['type' => 'github'])
                            </a>

                            <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="Instagram">
                                @include('partials.social-icon', ['type' => 'instagram'])
                            </a>

                            <a href="mailto:{{ $user->email_contact ?: ($user->email ?: 'thoriqpasya860@gmail.com') }}" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="Email: thoriqpasya860@gmail.com">
                                @include('partials.social-icon', ['type' => 'email'])
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Navigation Columns -->
                <div class="lg:col-span-5 xl:col-span-5 grid grid-cols-2 sm:grid-cols-3 gap-6 sm:gap-8 min-w-0">
                    <!-- Column 1: Navigation -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Navigation</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="#hero" class="text-slate-300 hover:text-accent-400 transition-colors">Home</a></li>
                            <li><a href="#about" class="text-slate-300 hover:text-accent-400 transition-colors">About Me</a></li>
                            <li><a href="#services" class="text-slate-300 hover:text-accent-400 transition-colors">Services</a></li>
                            <li><a href="#experience" class="text-slate-300 hover:text-accent-400 transition-colors">Experiences</a></li>
                            <li><a href="#projects" class="text-slate-300 hover:text-accent-400 transition-colors">Projects</a></li>
                        </ul>
                    </div>

                    <!-- Column 2: Services -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Services</h4>
                        <ul class="space-y-2.5 text-sm text-slate-300">
                            <li><span>UI/UX Design</span></li>
                            <li><span>Web Design</span></li>
                            <li><span>Graphic Design</span></li>
                            <li><span>Design System</span></li>
                        </ul>
                    </div>

                    <!-- Column 3: Explore -->
                    <div>
                        <h4 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Explore</h4>
                        <ul class="space-y-2.5 text-sm">
                            <li><a href="#testimonials" class="text-slate-300 hover:text-accent-400 transition-colors">Testimonials</a></li>
                            <li><a href="#contact" class="text-slate-300 hover:text-accent-400 transition-colors">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Bottom Copyright Bar -->
            <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
                <div class="flex items-center gap-6">
                    <span class="hover:text-white transition-colors cursor-pointer">Privacy Policy</span>
                    <span>&bull;</span>
                    <span class="hover:text-white transition-colors cursor-pointer">Terms of Service</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts for Navigation, Scrollspy, Animations & Counters -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // 1. Mobile Menu Handling
            const menuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const iconOpen = document.getElementById('menu-icon-open');
            const iconClose = document.getElementById('menu-icon-close');

            if (menuBtn && mobileMenu) {
                menuBtn.addEventListener('click', () => {
                    const isHidden = mobileMenu.classList.contains('hidden');
                    if (isHidden) {
                        mobileMenu.classList.remove('hidden');
                        iconOpen.classList.add('hidden');
                        iconClose.classList.remove('hidden');
                    } else {
                        mobileMenu.classList.add('hidden');
                        iconOpen.classList.remove('hidden');
                        iconClose.classList.add('hidden');
                    }
                });

                document.querySelectorAll('.mobile-nav-item').forEach(item => {
                    item.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        iconOpen.classList.remove('hidden');
                        iconClose.classList.add('hidden');
                    });
                });
            }

            // 2. Scrollspy Active Link Highlighting & Navbar Dynamic Style
            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-item');
            const mainHeader = document.getElementById('main-header');

            function handleScroll() {
                const scrollPos = window.scrollY;

                // Subtle header elevation
                if (mainHeader) {
                    if (scrollPos > 30) {
                        mainHeader.classList.add('top-2', 'sm:top-3');
                        mainHeader.classList.remove('top-3', 'sm:top-4');
                    } else {
                        mainHeader.classList.add('top-3', 'sm:top-4');
                        mainHeader.classList.remove('top-2', 'sm:top-3');
                    }
                }

                // Active section detection
                const navCheckPos = scrollPos + 220;
                sections.forEach(section => {
                    const top = section.offsetTop;
                    const height = section.offsetHeight;
                    const id = section.getAttribute('id');
                    if (navCheckPos >= top && navCheckPos < top + height) {
                        navLinks.forEach(link => {
                            if (link.getAttribute('href').endsWith('#' + id)) {
                                link.classList.add('text-accent-500', 'font-semibold');
                                link.classList.remove('text-slate-600');
                            } else {
                                link.classList.remove('text-accent-500', 'font-semibold');
                                link.classList.add('text-slate-600');
                            }
                        });
                    }
                });
            }

            window.addEventListener('scroll', handleScroll, { passive: true });
            handleScroll();

            // 3. High Performance Scroll Reveal via IntersectionObserver
            const revealElements = document.querySelectorAll('.reveal-on-scroll, .reveal-left, .reveal-right, .reveal-scale');
            if ('IntersectionObserver' in window && revealElements.length > 0) {
                const revealObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('revealed');
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    root: null,
                    threshold: 0.12,
                    rootMargin: '0px 0px -40px 0px'
                });

                revealElements.forEach(el => revealObserver.observe(el));
            } else {
                // Fallback for older browsers
                revealElements.forEach(el => el.classList.add('revealed'));
            }

            // 4. Animated Number Counter Ticker (CountUp with easeOutExpo)
            const counterElements = document.querySelectorAll('[data-counter-target]');
            if ('IntersectionObserver' in window && counterElements.length > 0) {
                const counterObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const el = entry.target;
                            const target = parseFloat(el.getAttribute('data-counter-target'));
                            const suffix = el.getAttribute('data-counter-suffix') || '';
                            const prefix = el.getAttribute('data-counter-prefix') || '';
                            const duration = parseInt(el.getAttribute('data-counter-duration') || '1600', 10);
                            const hasComma = el.getAttribute('data-counter-comma') === 'true';

                            if (!isNaN(target)) {
                                const startTime = performance.now();
                                function updateCounter(currentTime) {
                                    const elapsed = currentTime - startTime;
                                    const progress = Math.min(elapsed / duration, 1);
                                    // Smooth easeOutExpo curve
                                    const ease = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
                                    const currentVal = Math.floor(ease * target);
                                    const formatted = hasComma ? currentVal.toLocaleString('id-ID') : currentVal;
                                    el.textContent = prefix + formatted + suffix;

                                    if (progress < 1) {
                                        requestAnimationFrame(updateCounter);
                                    } else {
                                        const finalFormatted = hasComma ? target.toLocaleString('id-ID') : target;
                                        el.textContent = prefix + finalFormatted + suffix;
                                    }
                                }
                                requestAnimationFrame(updateCounter);
                            }
                            observer.unobserve(el);
                        }
                    });
                }, {
                    threshold: 0.25
                });

                counterElements.forEach(el => counterObserver.observe(el));
            }
        });
    </script>
</body>
</html>
