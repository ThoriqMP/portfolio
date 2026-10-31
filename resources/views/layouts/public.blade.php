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

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700;1,800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
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
        /* Base Paper Texture using SVG Fractal Noise */
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAF8F5;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 400 400' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.038'/%3E%3C/svg%3E");
            color: #0F172A;
            overflow-x: hidden;
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
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.08);
            border-color: rgba(255, 77, 45, 0.3);
        }

        /* Organic paper card */
        .paper-card {
            background-color: #FFFFFF;
            border: 1px solid #E8E3D8;
            border-radius: 1.5rem;
            box-shadow: 0 4px 18px -2px rgba(45, 35, 25, 0.04);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .paper-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 28px -4px rgba(45, 35, 25, 0.08);
            border-color: rgba(255, 77, 45, 0.35);
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
<body class="min-h-screen flex flex-col antialiased selection:bg-accent-500 selection:text-white">

    <!-- Header / Navigation (Floating Pill Navbar) -->
    @include('partials.navbar')

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer (Deep Dark Luxury Section with Giant Faded Watermark from Mockup) -->
    <footer id="contact" class="bg-dark-950 text-white pt-24 pb-12 relative overflow-hidden border-t border-slate-800/80">
        <!-- Giant Watermark Background Text at bottom of footer (from mockup) -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 select-none text-[12rem] sm:text-[18rem] md:text-[24rem] font-black text-white/[0.035] leading-none tracking-tighter uppercase pointer-events-none z-0 whitespace-nowrap">
            {{ strtoupper(explode(' ', $user->name ?? 'ETHAN')[0]) }}
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Top Footer Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 pb-20 border-b border-slate-800/80">
                <!-- Left: Big CTA & Direct Contact -->
                <div class="lg:col-span-6 space-y-6">
                    <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-accent-400">
                        <span class="w-2 h-2 rounded-full bg-accent-500"></span>
                        Let's Talk
                    </span>
                    
                    <div>
                        <a href="mailto:{{ $user->email_contact ?? 'hi@getincontact.com' }}" class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white hover:text-accent-400 transition-colors tracking-tight block">
                            {{ $user->email_contact ?? 'hi@getincontact.com' }}
                        </a>
                        <p class="text-slate-400 text-sm mt-3 max-w-md leading-relaxed font-normal">
                            Have an idea, a project inquiry, or just want to chat? Send me an email and let's craft something remarkable together.
                        </p>
                    </div>

                    <!-- Social Media Links (Modern Circular Pills) -->
                    <div class="flex items-center gap-3 pt-4">
                        @if ($user->socialLinks && $user->socialLinks->count() > 0)
                            @foreach ($user->socialLinks as $social)
                                <a href="{{ $social->link }}" target="_blank" rel="noopener noreferrer" title="{{ $social->name }}" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200">
                                    <span class="text-xs font-bold uppercase">{{ substr($social->name, 0, 2) }}</span>
                                </a>
                            @endforeach
                        @else
                            @if ($user->linkedin_link ?? true)
                                <a href="{{ $user->linkedin_link ?? 'https://linkedin.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="LinkedIn">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" /></svg>
                                </a>
                            @endif

                            @if ($user->github_link ?? true)
                                <a href="{{ $user->github_link ?? 'https://github.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="GitHub">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M12 2C6.477 2 2 6.477 2 12c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.603-3.369-1.34-3.369-1.34-.454-1.156-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.087 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.269 2.75 1.025A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.294 2.747-1.025 2.747-1.025.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.935.359.309.678.919.678 1.852 0 1.336-.012 2.415-.012 2.743 0 .267.18.579.688.481C19.137 20.162 22 16.418 22 12c0-5.523-4.477-10-10-10z" /></svg>
                                </a>
                            @endif

                            <a href="{{ $user->instagram_link ?? 'https://instagram.com' }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="Instagram">
                                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Right: Navigation Columns -->
                <div class="lg:col-span-6 grid grid-cols-2 sm:grid-cols-3 gap-8">
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
                            <li><a href="{{ route('login') }}" class="text-slate-400 hover:text-white transition-colors">CMS Admin</a></li>
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

    <!-- Scripts for Navigation, Scrollspy & Mobile Menu -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
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

            const sections = document.querySelectorAll('section[id]');
            const navLinks = document.querySelectorAll('.nav-item');

            function highlightNavOnScroll() {
                const scrollPos = window.scrollY + 200;
                sections.forEach(section => {
                    const top = section.offsetTop;
                    const height = section.offsetHeight;
                    const id = section.getAttribute('id');
                    if (scrollPos >= top && scrollPos < top + height) {
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

            window.addEventListener('scroll', highlightNavOnScroll);
            highlightNavOnScroll();
        });
    </script>
</body>
</html>
