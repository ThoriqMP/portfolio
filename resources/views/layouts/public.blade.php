<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }} &mdash; {{ $user->title ?? 'Digital Product Designer' }}</title>
    
    <!-- Meta Tags for SEO -->
    <meta name="description" content="Portofolio profesional {{ $user->name }}. Menampilkan karya desain produk digital, UI/UX, web design, dan studi kasus desain.">
    <meta name="keywords" content="Portfolio, UI/UX Designer, Digital Product Designer, Web Developer, Web Design">
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
                            50: '#FFF5F2',
                            100: '#FFEAE3',
                            200: '#FFD4C7',
                            300: '#FFAE99',
                            400: '#FF7E60',
                            500: '#FF4D2D', // Primary vibrant reddish-orange
                            600: '#E63E1F',
                            700: '#C42F13',
                            800: '#9E2711',
                            900: '#7F2413',
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
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFC;
            color: #0F172A;
            overflow-x: hidden;
        }

        ::selection {
            background-color: #FF4D2D;
            color: #ffffff;
        }

        /* Glassmorphism header */
        .glass-header {
            background: rgba(255, 255, 255, 0.88);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
        }

        /* Coordinate grid background for hero */
        .bg-hero-grid {
            background-image: 
                linear-gradient(to right, rgba(15, 23, 42, 0.04) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 23, 42, 0.04) 1px, transparent 1px);
            background-size: 36px 36px;
        }

        /* Warm reddish-orange tinted grid for Experience & CTA sections */
        .bg-warm-grid {
            background-color: #FFF6F3;
            background-image: 
                linear-gradient(to right, rgba(255, 77, 45, 0.08) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(255, 77, 45, 0.08) 1px, transparent 1px);
            background-size: 36px 36px;
        }

        /* Subtle smooth card hover lift */
        .modern-card {
            background-color: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 1.5rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }
        .modern-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.08);
            border-color: rgba(255, 77, 45, 0.25);
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
            background: #FAFAFC;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
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

    <!-- Footer (Deep Dark Luxury Section with Giant Faded Watermark) -->
    <footer id="contact" class="bg-dark-950 text-white pt-24 pb-12 relative overflow-hidden">
        <!-- Giant Watermark Background Text at bottom of footer -->
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
                        <p class="text-slate-400 text-sm mt-3 max-w-md leading-relaxed">
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
                            <!-- Default Curated Socials -->
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

                            @if ($user->phone)
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $user->phone) }}" target="_blank" rel="noopener noreferrer" class="w-10 h-10 rounded-full bg-slate-900 border border-slate-800 text-slate-300 hover:text-white hover:bg-accent-500 hover:border-accent-500 flex items-center justify-center transition-all duration-200" title="WhatsApp">
                                    <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.717-1.458L0 24zm6.26-4.526c1.661.987 3.291 1.488 4.966 1.489 5.517 0 10.005-4.48 10.008-9.998.001-2.673-1.037-5.185-2.923-7.072C16.483 2.006 13.977.969 11.3.969 5.787.969 1.3 5.449 1.297 10.969c-.001 1.761.464 3.424 1.348 4.96L1.67 21.5l5.59-1.463c-.347-.206-.693-.412-1.04-.619-.103-.062-.206-.124-.309-.187-.001-.001-.001-.001-.001-.001v.001zm11.517-7.834c-.27-.135-1.597-.788-1.846-.878-.248-.09-.429-.135-.61.135-.181.271-.7 1.035-.858 1.216-.158.18-.316.203-.586.068-.27-.136-1.14-.42-2.171-1.339-.802-.716-1.343-1.6-1.501-1.871-.158-.271-.017-.417.118-.552.122-.122.27-.316.406-.474.135-.158.18-.271.27-.451.09-.18.045-.339-.022-.475-.068-.135-.61-1.467-.836-2.009-.22-.53-.442-.458-.61-.466-.158-.008-.339-.008-.52-.008-.18 0-.474.068-.722.339-.248.271-.948.927-.948 2.26 0 1.332.97 2.617 1.106 2.798.135.18 1.907 2.911 4.62 4.082.645.278 1.149.444 1.542.569.648.206 1.237.177 1.703.107.519-.078 1.597-.653 1.822-1.284.226-.632.226-1.173.158-1.285-.068-.113-.248-.18-.519-.315z" /></svg>
                                </a>
                            @endif
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
                        <ul class="space-y-2.5 text-sm">
                            <li><span class="text-slate-300">UI/UX Design</span></li>
                            <li><span class="text-slate-300">Web Design</span></li>
                            <li><span class="text-slate-300">Graphic Design</span></li>
                            <li><span class="text-slate-300">Design System</span></li>
                            <li><span class="text-slate-300">App Development</span></li>
                        </ul>
                    </div>

                    <!-- Column 3: Company / Legal -->
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
            // Mobile Menu Toggle
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

                // Close menu when a link is clicked
                document.querySelectorAll('.mobile-nav-item').forEach(item => {
                    item.addEventListener('click', () => {
                        mobileMenu.classList.add('hidden');
                        iconOpen.classList.remove('hidden');
                        iconClose.classList.add('hidden');
                    });
                });
            }

            // Scrollspy Active Section Indicator
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
