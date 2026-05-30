<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portofolio {{ $user->name }} - {{ $user->title ?? 'Web Developer' }}</title>
    
    <!-- Meta Tags for SEO -->
    <meta name="description" content="Portofolio profesional dan riwayat karir {{ $user->name }}. Menampilkan proyek web development terbaru, riwayat pendidikan, dan pengalaman kerja.">
    <meta name="keywords" content="Portfolio, Web Developer, Resume, CV, Laravel, Tailwind CSS, PHP">
    <meta name="author" content="{{ $user->name }}">

    <!-- Google Fonts: Space Grotesk (Brutalist Choice) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700;850&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Space Grotesk"', 'sans-serif'],
                    },
                    colors: {
                        brutalOrange: '#ff5722',
                        brutalYellow: '#ffeb3b',
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Space Grotesk', sans-serif;
            background-color: #f5f5f5;
        }
        /* Page sections scroll offsets */
        section {
            scroll-margin-top: 1.5rem;
        }
        @media (min-width: 768px) {
            section {
                scroll-margin-top: 7rem;
            }
        }
        /* Structural Neo-Brutalist Card Helper Class */
        .brutal-card {
            background-color: #ffffff;
            border: 4px solid #000000;
            box-shadow: 6px 6px 0px #000000;
            transition: all 0.15s ease-out;
        }
        .brutal-card:hover {
            transform: translate(-4px, -4px);
            box-shadow: 10px 10px 0px #000000;
        }
        .brutal-card:active {
            transform: translate(6px, 6px);
            box-shadow: 0px 0px 0px #000000;
        }

        /* Brutalist Button Helper Class */
        .brutal-btn {
            background-color: #ff5722;
            color: #000000;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 3px solid #000000;
            box-shadow: 4px 4px 0px #000000;
            transition: all 0.1s ease-out;
        }
        .brutal-btn:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px #000000;
        }
        .brutal-btn:active {
            transform: translate(4px, 4px);
            box-shadow: 0px 0px 0px #000000;
        }

        /* Slide animations for active location tracker name (Desktop - absolute left-0) */
        @keyframes slideOutLeft {
            0% {
                transform: translateX(0);
                opacity: 1;
            }
            100% {
                transform: translateX(-100%);
                opacity: 0;
            }
        }
        @keyframes slideInRight {
            0% {
                transform: translateX(100%);
                opacity: 0;
            }
            100% {
                transform: translateX(0);
                opacity: 1;
            }
        }
        .slide-out-left {
            animation: slideOutLeft 0.15s forwards ease-in;
        }
        .slide-in-right {
            animation: slideInRight 0.2s forwards ease-out;
        }

        /* Slide animations for active location tracker name (Mobile - absolute center left-1/2 -translate-x-1/2) */
        @keyframes slideOutLeftMobile {
            0% {
                transform: translate(-50%, 0);
                opacity: 1;
            }
            100% {
                transform: translate(-150%, 0);
                opacity: 0;
            }
        }
        @keyframes slideInRightMobile {
            0% {
                transform: translate(50%, 0);
                opacity: 0;
            }
            100% {
                transform: translate(-50%, 0);
                opacity: 1;
            }
        }
        .slide-out-left-mobile {
            animation: slideOutLeftMobile 0.15s forwards ease-in;
        }
        .slide-in-right-mobile {
            animation: slideInRightMobile 0.2s forwards ease-out;
        }
    </style>
</head>
<body class="text-black min-h-screen flex flex-col selection:bg-black selection:text-[#ff5722]">

    <!-- Header / Navigation (Floating Brutalist Bar Component) -->
    @include('partials.navbar')

    <!-- Main Content (Flat layout) -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-black text-white py-16 border-t-8 border-black">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
                <div>
                    <h3 class="text-3xl font-black uppercase tracking-tighter">{{ $user->name }}<span class="text-[#ff5722]">_</span></h3>
                    <p class="text-slate-400 mt-2 text-sm uppercase tracking-wider">Fullstack Web Developer</p>
                </div>
                <div class="text-center md:text-right text-xs text-slate-500">
                    <p>&copy; {{ date('Y') }} {{ $user->name }}. All rights reserved.</p>
                    <p class="mt-2 text-xxs uppercase font-semibold text-[#ff5722]">Laravel 11 &bull; Tailwind CSS &bull; MySQL &bull; Brutalist Concept</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Vanilla Javascript for Navigation & Scroll Section Tracking -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section[id]');
            const activeIndicator = document.getElementById('active-section-name');
            const activeIndicatorMobile = document.getElementById('active-section-name-mobile');
            
            const sectionNames = {
                'hero': 'BERANDA',
                'about': 'TENTANG',
                'projects': 'PROYEK',
                'timeline': 'RIWAYAT'
            };

            let currentActiveSection = 'hero';

            function updateActiveSection(newSectionId) {
                if (currentActiveSection === newSectionId) return;
                currentActiveSection = newSectionId;

                const newText = sectionNames[newSectionId] || 'PORTFOLIO';

                // 1. Trigger slide-out-left animation for Desktop
                if (activeIndicator) {
                    activeIndicator.classList.remove('slide-in-right');
                    activeIndicator.classList.add('slide-out-left');
                }

                // 2. Trigger slide-out-left animation for Mobile (centered version)
                if (activeIndicatorMobile) {
                    activeIndicatorMobile.classList.remove('slide-in-right-mobile');
                    activeIndicatorMobile.classList.add('slide-out-left-mobile');
                }

                // 3. Wait for exit animation to complete, update texts, then slide in from right to left
                setTimeout(() => {
                    if (activeIndicator) {
                        activeIndicator.innerText = newText;
                        activeIndicator.classList.remove('slide-out-left');
                        activeIndicator.classList.add('slide-in-right');
                    }
                    
                    if (activeIndicatorMobile) {
                        activeIndicatorMobile.innerText = `// ${newText} //`;
                        activeIndicatorMobile.classList.remove('slide-out-left-mobile');
                        activeIndicatorMobile.classList.add('slide-in-right-mobile');
                    }
                }, 150);

                // 4. Highlight current active nav link in orange with brutalist border and offset
                document.querySelectorAll('nav a').forEach(link => {
                    link.classList.remove('bg-[#ff5722]', 'border-black', 'shadow-[2px_2px_0px_#000000]');
                    link.classList.add('border-transparent');
                });

                let targetLinkId = '';
                if (newSectionId === 'about') targetLinkId = 'nav-link-about';
                else if (newSectionId === 'projects') targetLinkId = 'nav-link-projects';
                else if (newSectionId === 'timeline') targetLinkId = 'nav-link-timeline';

                const activeLink = document.getElementById(targetLinkId);
                if (activeLink) {
                    activeLink.classList.remove('border-transparent');
                    activeLink.classList.add('bg-[#ff5722]', 'border-black', 'shadow-[2px_2px_0px_#000000]');
                }
            }

            // Scroll listener with a throttle-friendly approach
            window.addEventListener('scroll', () => {
                let current = 'hero';
                const scrollPosition = window.scrollY + 250; // Offset for active section trigger

                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        current = section.getAttribute('id');
                    }
                });

                updateActiveSection(current);
            });

            // Automated Carousel Slideshow for Projects (500ms slide cycle)
            const carousels = document.querySelectorAll('[id^="carousel-"]');
            carousels.forEach(carousel => {
                const items = carousel.querySelectorAll('.carousel-item');
                if (items.length <= 1) return;
                
                let currentIndex = 0;
                setInterval(() => {
                    // Hide current active slide
                    items[currentIndex].classList.remove('opacity-100');
                    items[currentIndex].classList.add('opacity-0');
                    
                    // Cycle next slide index
                    currentIndex = (currentIndex + 1) % items.length;
                    
                    // Show new active slide
                    items[currentIndex].classList.remove('opacity-0');
                    items[currentIndex].classList.add('opacity-100');
                }, 3000); // 3 seconds interval
            });
        });
    </script>
</body>
</html>
