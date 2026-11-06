<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Admin Panel — Portofolio</title>
    <!-- App Favicon & Icons -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.svg') }}">
    
    <!-- Google Fonts: Plus Jakarta Sans & Unbounded -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,600;1,700;1,800&family=Unbounded:wght@700;800;900&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS Play CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.css">
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.2/cropper.min.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
                        brand: ['"Unbounded"', 'system-ui', 'sans-serif'],
                    },
                    colors: {
                        accent: {
                            50: '#FFF5F0',
                            100: '#FFE8DF',
                            200: '#FFD2C2',
                            300: '#FFAC93',
                            400: '#FF7B58',
                            500: '#FF4D2D',
                            600: '#E63D1F',
                            700: '#C42F13',
                        },
                        brutalOrange: '#FF4D2D',
                        sidebar: '#0B0F17',
                    },
                    boxShadow: {
                        'xs': '0 1px 2px 0 rgba(0, 0, 0, 0.04)',
                        'glow': '0 0 20px -3px rgba(255, 77, 45, 0.35)',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
            background-color: #F8FAFC;
        }

        /* Modernized Utility Classes for Backward-Compatibility */
        .brutal-btn-admin {
            background-color: #FF4D2D;
            color: #ffffff;
            font-weight: 700;
            border-radius: 0.75rem; /* rounded-xl */
            padding: 0.625rem 1.25rem;
            box-shadow: 0 1px 3px 0 rgba(255, 77, 45, 0.25), 0 1px 2px -1px rgba(255, 77, 45, 0.25);
            transition: all 0.15s ease-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            border: 1px solid transparent;
            cursor: pointer;
        }
        .brutal-btn-admin:hover {
            background-color: #E63D1F;
            box-shadow: 0 4px 14px 0 rgba(255, 77, 45, 0.38);
            transform: translateY(-1px);
        }
        .brutal-btn-admin:active {
            transform: translateY(0);
            box-shadow: 0 1px 2px 0 rgba(255, 77, 45, 0.2);
        }

        .brutal-btn-secondary {
            background-color: #ffffff;
            color: #1e293b;
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.625rem 1.25rem;
            border: 1px solid #e2e8f0;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.04);
            transition: all 0.15s ease-out;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            cursor: pointer;
        }
        .brutal-btn-secondary:hover {
            background-color: #f8fafc;
            border-color: #cbd5e1;
            color: #0f172a;
            transform: translateY(-1px);
            box-shadow: 0 2px 6px 0 rgba(0, 0, 0, 0.06);
        }
        .brutal-btn-secondary:active {
            transform: translateY(0);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
</head>
<body class="text-slate-800 min-h-screen flex flex-col font-sans bg-[#F8FAFC] selection:bg-[#FF4D2D] selection:text-white antialiased">

    <!-- Mobile Header -->
    <header class="lg:hidden bg-[#0B0F17] border-b border-slate-800/80 px-4 py-3.5 flex items-center justify-between sticky top-0 z-40">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
            <div class="relative w-8 h-8 rounded-lg bg-[#151D2A] border border-slate-700/80 flex items-center justify-center font-brand font-black text-white text-sm">
                <span>T</span>
                <span class="absolute -top-0.5 -right-0.5 w-2 h-2 rounded-full bg-[#FF4D2D] ring-2 ring-[#0B0F17]"></span>
            </div>
            <div>
                <span class="font-brand font-bold text-sm tracking-tight text-white">THORIQ<span class="text-[#FF4D2D]">.</span></span>
                <span class="block text-[9px] uppercase font-bold text-slate-400 tracking-widest leading-none">CMS Panel</span>
            </div>
        </a>
        <button type="button" id="mobile-sidebar-toggle" class="p-2 rounded-xl border border-slate-800 bg-slate-900/80 hover:bg-slate-800 text-slate-300 hover:text-white transition">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>
    </header>

    <div class="flex flex-1 relative">
        <!-- Sidebar Navigation (Modern Luxury Dark Panel) -->
        <aside id="sidebar" class="fixed lg:sticky top-0 lg:top-0 lg:h-screen z-50 lg:z-30 w-72 bg-[#0B0F17] border-r border-slate-800/80 p-5 flex flex-col justify-between hidden lg:flex transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="space-y-6">
                <!-- Branding Header -->
                <div class="pb-5 border-b border-slate-800/80 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="relative w-10 h-10 rounded-xl bg-gradient-to-br from-[#1C2536] to-[#111827] border border-slate-700/80 flex items-center justify-center font-brand font-black text-white text-base shadow-inner group-hover:border-[#FF4D2D]/60 transition">
                            <span>T</span>
                            <span class="absolute -top-1 -right-1 w-3 h-3 rounded-full bg-[#FF4D2D] ring-2 ring-[#0B0F17] shadow-sm shadow-[#FF4D2D]/50 animate-pulse"></span>
                        </div>
                        <div>
                            <div class="flex items-center gap-1.5">
                                <span class="font-brand font-black text-base tracking-tight text-white">THORIQ<span class="text-[#FF4D2D]">.</span></span>
                            </div>
                            <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider block">Admin Portfolio CMS</span>
                        </div>
                    </a>
                </div>

                <!-- Navigation Section -->
                <div>
                    <span class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 block mb-2.5">Menu Utama</span>
                    <nav class="space-y-1.5">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.dashboard') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                            </svg>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        
                        <!-- Projects -->
                        <a href="{{ route('admin.projects.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.projects.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                            <span class="text-sm">Portofolio Proyek</span>
                        </a>
                        
                        <!-- Educations -->
                        <a href="{{ route('admin.educations.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.educations.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
                            </svg>
                            <span class="text-sm">Riwayat Pendidikan</span>
                        </a>
                        
                        <!-- Experiences -->
                        <a href="{{ route('admin.experiences.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.experiences.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 00.75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 00-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0112 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 01-.673-.38m0 0A2.18 2.18 0 013 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 013.413-.387m7.5 0V5.25A2.25 2.25 0 0013.5 3h-3a2.25 2.25 0 00-2.25 2.25v.894m7.5 0a48.667 48.667 0 00-7.5 0M12 12.75h.008v.008H12v-.008z" />
                            </svg>
                            <span class="text-sm">Pengalaman Kerja</span>
                        </a>

                        <!-- Badges -->
                        <a href="{{ route('admin.badges.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.badges.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581a2.25 2.25 0 003.182 0l4.318-4.318a2.25 2.25 0 000-3.182L11.16 3.659A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 7.5h.008v.008H6V7.5z" />
                            </svg>
                            <span class="text-sm">Lencana Keahlian</span>
                        </a>
     
                        <!-- Socials -->
                        <a href="{{ route('admin.socials.index') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.socials.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span class="text-sm">Kelola Sosial Media</span>
                        </a>

                        <!-- Profile -->
                        <a href="{{ route('admin.profile.edit') }}" 
                           class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition duration-150 {{ Route::is('admin.profile.*') ? 'bg-gradient-to-r from-[#FF4D2D] to-[#E63D1F] text-white font-bold shadow-md shadow-[#FF4D2D]/25' : 'text-slate-400 hover:text-white hover:bg-slate-800/60 font-semibold' }}">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="text-sm">Profil &amp; Portofolio</span>
                        </a>
                    </nav>
                </div>
            </div>

            <!-- User Session Card & Logout -->
            <div class="pt-5 border-t border-slate-800/80 space-y-3">
                <div class="bg-slate-900/90 border border-slate-800/90 rounded-2xl p-3 flex items-center justify-between shadow-inner">
                    <div class="flex items-center gap-3 overflow-hidden">
                        <div class="relative w-9 h-9 rounded-xl bg-slate-800 border border-slate-700 overflow-hidden flex-shrink-0 flex items-center justify-center font-bold">
                            @if (Auth::user() && Auth::user()->avatar_path && \Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->avatar_path))
                                <img src="{{ asset('storage/' . Auth::user()->avatar_path) }}" alt="{{ Auth::user()->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-[#FF4D2D] text-white flex items-center justify-center font-black uppercase text-sm">
                                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                                </div>
                            @endif
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 rounded-full bg-emerald-500 ring-2 ring-[#0B0F17]"></span>
                        </div>
                        <div class="truncate">
                            <h4 class="text-xs font-bold text-white truncate leading-tight">{{ Auth::user()->name ?? 'Admin' }}</h4>
                            <span class="text-[10px] text-slate-400 font-medium">@ {{ Auth::user()->username ?? 'admin' }}</span>
                        </div>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" title="Keluar Sesi" class="p-2 rounded-xl text-slate-400 hover:text-rose-400 hover:bg-rose-500/10 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content Area with Modern Top Header Bar -->
        <div class="flex-grow flex flex-col min-w-0">
            <!-- Sleek Top Header Bar (Desktop & Tablet) -->
            <header class="bg-white/90 backdrop-blur-md border-b border-slate-200/80 px-6 py-3.5 sticky top-0 z-20 flex items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                    <span class="text-slate-400">Admin</span>
                    <span class="text-slate-300">/</span>
                    <span class="text-slate-800 font-bold">
                        @if(Route::is('admin.dashboard'))
                            Ringkasan Dashboard
                        @elseif(Route::is('admin.projects.*'))
                            Portofolio Proyek
                        @elseif(Route::is('admin.educations.*'))
                            Riwayat Pendidikan
                        @elseif(Route::is('admin.experiences.*'))
                            Pengalaman Kerja
                        @elseif(Route::is('admin.badges.*'))
                            Lencana Keahlian
                        @elseif(Route::is('admin.socials.*'))
                            Kelola Sosial Media
                        @elseif(Route::is('admin.profile.*'))
                            Profil & Portofolio
                        @else
                            Panel Kontrol
                        @endif
                    </span>
                </div>

                <!-- Header Actions -->
                <div class="flex items-center gap-2.5">
                    <button type="button" onclick="openCvModal()" 
                       class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-slate-200 text-xs font-semibold text-slate-700 bg-white hover:bg-slate-50 transition shadow-xs cursor-pointer">
                        <svg class="w-3.5 h-3.5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                        <span>Unduh CV</span>
                    </button>
                    
                    <a href="/" target="_blank" 
                       class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-slate-900 hover:bg-[#FF4D2D] text-xs font-semibold text-white transition shadow-xs">
                        <span>Lihat Website</span>
                        <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                        </svg>
                    </a>
                </div>
            </header>

            <main class="flex-grow p-4 sm:p-6 lg:p-8 min-w-0 max-w-7xl w-full mx-auto">
                <!-- Toast Notification Banner -->
                @if (session('success'))
                    <div id="flash-alert" class="mb-6 p-4 bg-emerald-50 border border-emerald-200/90 rounded-2xl text-emerald-900 shadow-sm flex items-center justify-between transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-emerald-500 text-white flex items-center justify-center flex-shrink-0 shadow-sm">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                </svg>
                            </div>
                            <span class="text-sm font-semibold">{{ session('success') }}</span>
                        </div>
                        <button type="button" onclick="dismissAlert()" class="p-1 rounded-lg text-emerald-700 hover:bg-emerald-100 transition">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Forgiving Design Confirm Delete Modal Overlay -->
    <div id="delete-modal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-950/60 backdrop-blur-sm hidden opacity-0 transition-all duration-200">
        <div class="bg-white rounded-3xl border border-slate-200/90 p-6 sm:p-8 max-w-md w-full shadow-2xl scale-95 transition-all duration-200 text-center" id="delete-modal-card">
            <!-- Danger Icon Ring -->
            <div class="w-14 h-14 rounded-2xl bg-rose-50 border border-rose-100 text-rose-500 mx-auto mb-4 flex items-center justify-center shadow-inner">
                <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
            
            <h3 class="text-xl font-bold text-slate-900 tracking-tight">Konfirmasi Hapus</h3>
            <p class="text-sm text-slate-600 mt-2 leading-relaxed" id="delete-modal-text">
                Apakah Anda yakin ingin menghapus data ini? Tindakan ini bersifat permanen.
            </p>
            
            <div class="flex items-center justify-center gap-3 mt-7">
                <button type="button" id="delete-cancel-btn" class="brutal-btn-secondary px-5 py-2.5 text-xs font-semibold">
                    Batal
                </button>
                <form id="delete-confirm-form" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 text-xs font-semibold rounded-xl bg-rose-600 hover:bg-rose-700 text-white shadow-sm shadow-rose-600/30 transition">
                        Hapus Permanen
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Vanilla Javascript Interactivities -->
    <script>
        // Mobile Sidebar Toggle
        const toggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('sidebar');

        if (toggleBtn && sidebar) {
            toggleBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                const isHidden = sidebar.classList.contains('hidden');
                if (isHidden) {
                    sidebar.classList.remove('hidden');
                    setTimeout(() => {
                        sidebar.classList.remove('-translate-x-full');
                    }, 10);
                } else {
                    sidebar.classList.add('-translate-x-full');
                    setTimeout(() => {
                        sidebar.classList.add('hidden');
                    }, 300);
                }
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', (e) => {
                if (window.innerWidth < 1024 && !sidebar.classList.contains('hidden') && !sidebar.contains(e.target) && e.target !== toggleBtn) {
                    sidebar.classList.add('-translate-x-full');
                    setTimeout(() => {
                        sidebar.classList.add('hidden');
                    }, 300);
                }
            });
        }

        // Dismiss Alerts
        function dismissAlert() {
            const alert = document.getElementById('flash-alert');
            if (alert) {
                alert.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    alert.remove();
                }, 300);
            }
        }

        // Auto-dismiss alert after 5 seconds
        setTimeout(() => {
            dismissAlert();
        }, 5000);

        // Delete Modal Logic
        const deleteModal = document.getElementById('delete-modal');
        const deleteModalCard = document.getElementById('delete-modal-card');
        const deleteForm = document.getElementById('delete-confirm-form');
        const deleteCancelBtn = document.getElementById('delete-cancel-btn');
        const deleteModalText = document.getElementById('delete-modal-text');

        function triggerDelete(actionUrl, itemName = 'data ini') {
            deleteForm.setAttribute('action', actionUrl);
            deleteModalText.innerHTML = `Apakah Anda yakin ingin menghapus <strong class="text-slate-900 font-bold">${itemName}</strong>? Tindakan ini bersifat permanen demi keamanan data Anda.`;
            
            deleteModal.classList.remove('hidden');
            setTimeout(() => {
                deleteModal.classList.remove('opacity-0');
                deleteModalCard.classList.remove('scale-95');
            }, 10);
        }

        function hideDeleteModal() {
            deleteModal.classList.add('opacity-0');
            deleteModalCard.classList.add('scale-95');
            setTimeout(() => {
                deleteModal.classList.add('hidden');
            }, 200);
        }

        if (deleteCancelBtn) {
            deleteCancelBtn.addEventListener('click', hideDeleteModal);
        }

        if (deleteModal) {
            deleteModal.addEventListener('click', (e) => {
                if (e.target === deleteModal) hideDeleteModal();
            });
        }

        // ==========================================
        // CROPPER.JS AUTOMATION (MODERN LUXURY UI)
        // ==========================================
        document.addEventListener('DOMContentLoaded', () => {
            const fileInputs = document.querySelectorAll('input[type="file"]');
            
            fileInputs.forEach(fileInput => {
                // Only intercept image file uploads and exclude multiple uploads (gallery inputs)
                if (fileInput.accept && !fileInput.accept.includes('image')) return;
                if (fileInput.multiple) return;
                
                fileInput.addEventListener('change', (e) => {
                    const files = e.target.files;
                    if (!files || files.length === 0) return;
                    
                    const file = files[0];
                    if (!file.type.startsWith('image/')) return;
                    
                    // Prevent processing already cropped programmatically-injected blobs
                    if (fileInput.dataset.cropped === 'true') {
                        fileInput.dataset.cropped = 'false';
                        return;
                    }
                    
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        openCropperModal(fileInput, event.target.result, file.name);
                    };
                    reader.readAsDataURL(file);
                });
            });
        });

        let cropperInstance = null;

        function openCropperModal(fileInput, imageSrc, originalFileName) {
            let modal = document.getElementById('brutal-cropper-modal');
            if (!modal) {
                modal = document.createElement('div');
                modal.id = 'brutal-cropper-modal';
                modal.className = 'fixed inset-0 z-[60] flex items-center justify-center p-4 bg-slate-950/70 backdrop-blur-sm transition-all duration-200';
                modal.innerHTML = `
                    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-2xl p-5 sm:p-7 max-w-2xl w-full scale-95 transition-all duration-200 flex flex-col max-h-[90vh]" id="cropper-modal-card">
                        <!-- Header -->
                        <div class="pb-4 border-b border-slate-200/80 flex items-center justify-between mb-4">
                            <div>
                                <h3 class="text-base sm:text-lg font-bold text-slate-900 tracking-tight">Sesuaikan Tata Letak &amp; Crop Foto</h3>
                                <p class="text-xs text-slate-500 font-medium">Atur area tampilan foto agar pas dengan format kartu portofolio.</p>
                            </div>
                            <button type="button" id="cropper-close-x" class="w-8 h-8 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 flex items-center justify-center transition leading-none text-xl font-bold">&times;</button>
                        </div>
                        
                        <!-- Cropper Canvas Container -->
                        <div class="flex-grow min-h-[260px] max-h-[48vh] bg-slate-950 rounded-2xl overflow-hidden relative flex items-center justify-center shadow-inner">
                            <img id="cropper-target-image" src="" class="max-w-full max-h-full block">
                        </div>
                        
                        <!-- Ratio Toggle Controls -->
                        <div class="mt-4 space-y-3">
                            <div class="flex flex-wrap gap-2 items-center">
                                <span class="text-xs font-bold text-slate-700 mr-2">Rasio Aspek:</span>
                                <button type="button" data-ratio="1.7777777777777777" class="ratio-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-[#FF4D2D] text-white transition">16:9 (Cover)</button>
                                <button type="button" data-ratio="1" class="ratio-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">1:1 (Kotak)</button>
                                <button type="button" data-ratio="0" class="ratio-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">Bebas</button>
                            </div>
                            
                            <!-- Detailed Manipulation controls -->
                            <div class="flex flex-wrap gap-2 items-center pt-2.5 border-t border-slate-100">
                                <span class="text-xs font-bold text-slate-700 mr-2">Penyesuaian:</span>
                                <button type="button" id="crop-rotate-l" class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">Putar Kiri</button>
                                <button type="button" id="crop-rotate-r" class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">Putar Kanan</button>
                                <button type="button" id="crop-zoom-in" class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">+ Perbesar</button>
                                <button type="button" id="crop-zoom-out" class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">- Perkecil</button>
                                <button type="button" id="crop-reset" class="px-2.5 py-1 text-xs font-medium rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition">Reset</button>
                            </div>
                        </div>
                        
                        <!-- Confirmation Action buttons -->
                        <div class="flex items-center justify-end gap-3 mt-6 pt-4 border-t border-slate-200/80">
                            <button type="button" id="cropper-cancel-btn" class="brutal-btn-secondary px-5 py-2 text-xs font-semibold">
                                Batal
                            </button>
                            <button type="button" id="cropper-apply-btn" class="brutal-btn-admin px-5 py-2 text-xs font-semibold">
                                Terapkan &amp; Potong Foto
                            </button>
                        </div>
                    </div>
                `;
                document.body.appendChild(modal);
            }
            
            const modalCard = modal.querySelector('#cropper-modal-card');
            const targetImage = modal.querySelector('#cropper-target-image');
            
            targetImage.src = imageSrc;
            
            let defaultRatio = 1.7777777777777777; // default widescreen for projects
            if (fileInput.id === 'image' && window.location.href.includes('profile')) {
                defaultRatio = 1; // 1:1 square for profile avatar
            }
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                modalCard.classList.remove('scale-95');
            }, 10);
            
            if (cropperInstance) {
                cropperInstance.destroy();
            }
            
            cropperInstance = new Cropper(targetImage, {
                aspectRatio: defaultRatio,
                viewMode: 1,
                dragMode: 'move',
                autoCropArea: 0.9,
                restore: false,
                guides: true,
                center: true,
                highlight: false,
                cropBoxMovable: true,
                cropBoxResizable: true,
                toggleDragModeOnDblclick: false,
                ready: function() {
                    updateRatioButtons(defaultRatio);
                }
            });
            
            const ratioButtons = modal.querySelectorAll('.ratio-btn');
            ratioButtons.forEach(btn => {
                btn.onclick = () => {
                    const ratio = parseFloat(btn.dataset.ratio);
                    if (cropperInstance) {
                        cropperInstance.setAspectRatio(ratio === 0 ? NaN : ratio);
                        updateRatioButtons(ratio);
                    }
                };
            });
            
            function updateRatioButtons(activeRatio) {
                ratioButtons.forEach(btn => {
                    const r = parseFloat(btn.dataset.ratio);
                    if (Math.abs(r - activeRatio) < 0.001 || (isNaN(activeRatio) && r === 0) || (activeRatio === 0 && r === 0)) {
                        btn.className = 'ratio-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-[#FF4D2D] text-white shadow-sm shadow-[#FF4D2D]/20 transition';
                    } else {
                        btn.className = 'ratio-btn px-3 py-1.5 text-xs font-semibold rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 transition';
                    }
                });
            }
            
            modal.querySelector('#crop-rotate-l').onclick = () => cropperInstance && cropperInstance.rotate(-90);
            modal.querySelector('#crop-rotate-r').onclick = () => cropperInstance && cropperInstance.rotate(90);
            modal.querySelector('#crop-zoom-in').onclick = () => cropperInstance && cropperInstance.zoom(0.1);
            modal.querySelector('#crop-zoom-out').onclick = () => cropperInstance && cropperInstance.zoom(-0.1);
            modal.querySelector('#crop-reset').onclick = () => cropperInstance && cropperInstance.reset();
            
            const closeModal = () => {
                modal.classList.add('opacity-0');
                modalCard.classList.add('scale-95');
                setTimeout(() => {
                    modal.classList.add('hidden');
                    if (cropperInstance) {
                        cropperInstance.destroy();
                        cropperInstance = null;
                    }
                }, 200);
            };
            
            modal.querySelector('#cropper-close-x').onclick = closeModal;
            modal.querySelector('#cropper-cancel-btn').onclick = () => {
                closeModal();
                fileInput.value = '';
            };
            
            modal.querySelector('#cropper-apply-btn').onclick = () => {
                if (!cropperInstance) return;
                
                const canvasOptions = {
                    maxWidth: 2000,
                    maxHeight: 2000,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high'
                };
                
                const croppedCanvas = cropperInstance.getCroppedCanvas(canvasOptions);
                if (!croppedCanvas) return;
                
                croppedCanvas.toBlob((blob) => {
                    if (!blob) return;
                    
                    const croppedFile = new File([blob], originalFileName, { type: 'image/jpeg' });
                    
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(croppedFile);
                    
                    fileInput.dataset.cropped = 'true';
                    fileInput.files = dataTransfer.files;
                    
                    updateOnPagePreview(fileInput, blob);
                    closeModal();
                }, 'image/jpeg', 0.9);
            };
        }

        function updateOnPagePreview(fileInput, blob) {
            const objectUrl = URL.createObjectURL(blob);
            
            // 1. Profile Avatar page preview update
            if (window.location.href.includes('profile')) {
                const form = fileInput.closest('form');
                if (form) {
                    const avatarImg = form.querySelector('.w-28.h-28 img, .w-24.h-24 img, #current-avatar-img');
                    if (avatarImg) {
                        avatarImg.src = objectUrl;
                    } else {
                        const avatarBox = form.querySelector('.w-28.h-28, .w-24.h-24');
                        if (avatarBox) {
                            avatarBox.innerHTML = `<img src="${objectUrl}" class="w-full h-full object-cover">`;
                        }
                    }
                }
            }
            
            // 2. Project Create / Edit page preview update
            if (window.location.href.includes('projects')) {
                const form = fileInput.closest('form');
                if (form) {
                    const existingImg = form.querySelector('#current-thumbnail-preview, #create-thumbnail-preview');
                    if (existingImg) {
                        existingImg.src = objectUrl;
                        existingImg.classList.remove('hidden');
                        const emptyText = form.querySelector('#create-empty-text');
                        if (emptyText) emptyText.classList.add('hidden');
                        const tag = form.querySelector('#new-thumb-tag');
                        if (tag) tag.classList.remove('hidden');
                    }
                }
            }
        }

        // CV Customization Modal Controls
        function openCvModal() {
            const modal = document.getElementById('cv-modal');
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
                document.body.style.overflow = 'hidden';
                updateCvCounter();
            }
        }

        function closeCvModal() {
            const modal = document.getElementById('cv-modal');
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
                document.body.style.overflow = '';
            }
        }

        function toggleAllCvExp(checked) {
            document.querySelectorAll('.cv-exp-checkbox').forEach(cb => cb.checked = checked);
            updateCvCounter();
        }

        function updateCvCounter() {
            const total = document.querySelectorAll('.cv-exp-checkbox').length;
            const checked = document.querySelectorAll('.cv-exp-checkbox:checked').length;
            const counter = document.getElementById('cv-exp-counter');
            if (counter) {
                counter.textContent = `${checked} dari ${total} dipilih`;
            }
        }
    </script>

    <!-- CV Customization & Download Modal -->
    @php
        $cvExperiences = \App\Models\Experience::orderBy('start_date', 'desc')->get();
    @endphp
    <div id="cv-modal" class="fixed inset-0 z-50 bg-black/60 backdrop-blur-xs hidden items-center justify-center p-4" onclick="closeCvModal()">
        <div class="bg-white rounded-3xl border border-slate-200 shadow-2xl max-w-lg w-full overflow-hidden animate-in fade-in zoom-in-95 duration-200" onclick="event.stopPropagation()">
            
            <!-- Modal Header -->
            <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/70">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 border border-orange-100 text-[#FF4D2D] flex items-center justify-center shadow-2xs">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-extrabold text-slate-900 tracking-tight">Kustomisasi Unduh CV (PDF)</h3>
                        <p class="text-xs text-slate-500 font-medium">Pilih riwayat pengalaman kerja yang ingin dimasukkan.</p>
                    </div>
                </div>
                <button type="button" onclick="closeCvModal()" class="w-8 h-8 rounded-full bg-slate-200/60 hover:bg-slate-200 text-slate-500 hover:text-slate-900 flex items-center justify-center transition cursor-pointer">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Form -->
            <form id="cv-download-form" action="{{ route('admin.cv.download') }}" method="GET" target="_blank" class="p-6 space-y-5">
                
                <!-- Experiences Selection -->
                <div>
                    <div class="flex items-center justify-between mb-2.5">
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-700">Daftar Pengalaman Kerja</span>
                            <span id="cv-exp-counter" class="text-[11px] font-semibold text-[#FF4D2D] bg-orange-50 border border-orange-200 px-2.5 py-0.5 rounded-full">
                                {{ $cvExperiences->count() }} dipilih
                            </span>
                        </div>
                        <div class="flex items-center gap-2 text-xs">
                            <button type="button" onclick="toggleAllCvExp(true)" class="text-[#FF4D2D] hover:underline font-semibold cursor-pointer">Pilih Semua</button>
                            <span class="text-slate-300">&bull;</span>
                            <button type="button" onclick="toggleAllCvExp(false)" class="text-slate-500 hover:underline font-semibold cursor-pointer">Batal Semua</button>
                        </div>
                    </div>

                    <div class="max-h-56 overflow-y-auto space-y-2 pr-1 scrollbar-thin scrollbar-thumb-slate-200">
                        @forelse($cvExperiences as $exp)
                            <label class="flex items-start gap-3 p-3 rounded-xl border border-slate-200/90 hover:border-orange-300 hover:bg-orange-50/20 cursor-pointer transition select-none">
                                <input type="checkbox" name="experiences[]" value="{{ $exp->id }}" checked onchange="updateCvCounter()"
                                       class="cv-exp-checkbox mt-1 w-4 h-4 rounded text-[#FF4D2D] focus:ring-[#FF4D2D] border-slate-300">
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="text-xs font-bold text-slate-900 truncate">{{ $exp->company_name }}</span>
                                        <span class="text-[10px] text-slate-400 font-medium whitespace-nowrap">
                                            {{ $exp->start_date ? \Carbon\Carbon::parse($exp->start_date)->translatedFormat('M Y') : '' }} &ndash;
                                            {{ $exp->end_date ? \Carbon\Carbon::parse($exp->end_date)->translatedFormat('M Y') : 'Sekarang' }}
                                        </span>
                                    </div>
                                    <div class="text-[11px] text-slate-600 font-medium mt-0.5">{{ $exp->position }}</div>
                                </div>
                            </label>
                        @empty
                            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-center text-xs text-slate-500 font-medium">
                                Belum ada data pengalaman kerja yang tersimpan.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Extra Sections Toggle -->
                <div class="pt-3 border-t border-slate-100">
                    <span class="text-xs font-bold uppercase tracking-wider text-slate-700 block mb-2.5">Opsi Bagian Lainnya</span>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-white cursor-pointer transition select-none">
                            <input type="checkbox" name="include_photo" value="1" checked class="w-3.5 h-3.5 rounded text-[#FF4D2D] focus:ring-[#FF4D2D] border-slate-300">
                            <span class="font-medium text-slate-700">Foto Profil</span>
                        </label>
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-white cursor-pointer transition select-none">
                            <input type="checkbox" name="include_education" value="1" checked class="w-3.5 h-3.5 rounded text-[#FF4D2D] focus:ring-[#FF4D2D] border-slate-300">
                            <span class="font-medium text-slate-700">Riwayat Pendidikan</span>
                        </label>
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-white cursor-pointer transition select-none">
                            <input type="checkbox" name="include_projects" value="1" checked class="w-3.5 h-3.5 rounded text-[#FF4D2D] focus:ring-[#FF4D2D] border-slate-300">
                            <span class="font-medium text-slate-700">Proyek Unggulan</span>
                        </label>
                        <label class="flex items-center gap-2 p-2.5 rounded-xl border border-slate-200/80 bg-slate-50/50 hover:bg-white cursor-pointer transition select-none">
                            <input type="checkbox" name="include_skills" value="1" checked class="w-3.5 h-3.5 rounded text-[#FF4D2D] focus:ring-[#FF4D2D] border-slate-300">
                            <span class="font-medium text-slate-700">Keahlian &amp; Skills</span>
                        </label>
                    </div>
                </div>

                <!-- Modal Actions -->
                <div class="flex items-center justify-end gap-3 pt-3 border-t border-slate-100">
                    <button type="button" onclick="closeCvModal()" class="px-4 py-2.5 rounded-xl border border-slate-200 hover:bg-slate-50 text-xs font-semibold text-slate-600 transition cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" onclick="setTimeout(closeCvModal, 500)" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-slate-900 hover:bg-[#FF4D2D] text-white text-xs font-bold transition shadow-sm cursor-pointer">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                        </svg>
                        <span>Unduh Lembar CV (PDF)</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>